<?php

use app\Dao\UsuarioDaoMysql;
use app\Models\Auth;
use app\Models\Usuario;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php"; 

$path = __DIR__ . "\..";
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

require_once "../config/config.php"; 

$UsuarioDao = new UsuarioDaoMysql($pdo);
$Auth = new Auth($pdo, $base);


$usuario = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password",);


if($usuario && $password){

    if($Auth->validateLogin($usuario, $password)){
        $_SESSION["flash"] = "Usuário Logado com Sucesso";
        header("Location: ".$base);
        exit;
    }

}    

$_SESSION["flash"] = "Preencha Todos os Dados Corretamente";
header("Location: ".$base."/login");
exit;


?>