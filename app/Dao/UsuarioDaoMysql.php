<?php

namespace app\Dao;

use PDO;
use app\Interfaces\UsuarioDaoInterface;
use app\Models\Usuario;

class UsuarioDaoMysql implements UsuarioDaoInterface{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function generateUser($data){
        $Usuario = new Usuario;
        $Usuario->setId($data["id"]);
        $Usuario->setUsuario($data["usuario"]);
        $Usuario->setEmail($data["email"]);
        $Usuario->setToken($data["token"]);
        $Usuario->setAvatar($data["avatar"]);
        $Usuario->setPassword($data["password"]);
        $Usuario->setCreatedAt($data["created_at"]);
        
        return $Usuario;
    }

    public function create(Usuario $user)
    {
        $sql = $this->pdo->prepare("INSERT INTO usuarios
        (email, usuario, password, token, avatar, bio, created_at) VALUES (:email, :usuario, :password, :token, :avatar, :bio, :created_at)");    
        $sql->bindValue(":email", $user->getEmail());
        $sql->bindValue(":usuario", $user->getUsuario());
        $sql->bindValue(":password", $user->getPassword());
        $sql->bindValue(":token", $user->getToken());
        $sql->bindValue(":avatar", $user->getAvatar());
        $sql->bindValue(":created_at", $user->getCreatedAt());

        $sql->execute();        
    }

    public function findAll(){}

    public function findByName($name)
    {
        if(!empty($name)){

            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = :name");
            $sql->bindValue(":name", $name);
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->generateUser($data);
    
                return $user;
                exit; 
            }
    
        }

        return false;
        exit;
    }

    public function findByEmail($email)
    {
        if(!empty($email)){

            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $sql->bindValue(":email", $email);
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->generateUser($data);
    
                return $user;
                exit; 
            }
    
        }

        return false;
        exit;
    }

    public function findByToken($token)
    {
        if(!empty($token)){

            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE token = :token");
            $sql->bindValue(":token", $token);
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->generateUser($data);
    
                return $user;
                exit; 
            }
    
        }

        return false;
        exit;
    }

    public function update(Usuario $user)
    {
        $sql = $this->pdo->prepare("UPDATE usuarios SET 
            email = :email,
            usuario = :usuario,
            password = :password,
            token = :token,
            avatar = :avatar,
            created_at = :created_at
        WHERE id = :id");

        $sql->bindValue(":email", $user->getEmail());
        $sql->bindValue(":usuario", $user->getUsuario());
        $sql->bindValue(":password", $user->getPassword());
        $sql->bindValue(":token", $user->getToken());
        $sql->bindValue(":avatar", $user->getAvatar());
        $sql->bindValue(":created_at", $user->getCreatedAt());
        $sql->bindValue(":id", $user->getId());
        $sql->execute();

    }
    public function delete($id){}

}
