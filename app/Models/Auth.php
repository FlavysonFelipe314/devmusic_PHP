<?php

namespace app\Models;

use app\Dao\UsuarioDaoMysql;
use PDO;
use PgSql\Lob;

class Auth {

    private $pdo;
    private $base;


    public function __construct(PDO $driver, $base)
    {
        $this->pdo = $driver;
        $this->base = $base;
    }

    public function checkToken()
    {
        if(!empty($_SESSION["token"])){
            $token = $_SESSION["token"];
            $UsuarioDao = new UsuarioDaoMysql($this->pdo);

            $user = $UsuarioDao->findByToken($token);

            if($user){
                return $user;
                exit;
            }
        }
        header("Location: ". $this->base."/login");
        exit;
    }

    public function validateLogin($usuario,$senha)
    {
        $UsuarioDao = new UsuarioDaoMysql($this->pdo);
        $user = $UsuarioDao->findByName($usuario);

        if($user){

            if(password_verify($senha, $user->getPassword())){

                $token = md5(time().rand(0,9999));

                $_SESSION["token"] = $token;
                $user->setToken($token);
                $UsuarioDao->update($user);

                return true;
                exit;
            }
        }

        return false;
        exit;
    }

    public function registerUser($email, $usuario, $password){
        $newUser = new Usuario;
        $UsuarioDao = new UsuarioDaoMysql($this->pdo);

        $token = md5(time().rand(0,9999));
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $avatar = "default.png";
        $dateTime = date("Y-m-d H:i:s");

        $newUser->setEmail($email);
        $newUser->setUsuario($usuario);
        $newUser->setPassword($hash);
        $newUser->setToken($token);
        $newUser->setAvatar($avatar);
        $newUser->setCreatedAt($dateTime);

        $UsuarioDao->create($newUser);

        $_SESSION["token"] = $token;
    }
    
    public function logout(){
        $_SESSION["token"] = "";
        session_unset();
        session_destroy();
        header("Location: ". $this->base);
        exit;
    }
}
