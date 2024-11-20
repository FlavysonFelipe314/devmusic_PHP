<?php

use app\Dao\UsuarioDaoMysql;
use app\Models\Auth;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php"; 

$path = __DIR__ . "\..";
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

require_once "../config/config.php"; 

$UsuarioDao = new UsuarioDaoMysql($pdo);
$Auth = new Auth($pdo, $base);

$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$usuario = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password",);
$confirmPassword = filter_input(INPUT_POST, "confirmPassword",);


if($email && $usuario && $password && $confirmPassword){


    if($UsuarioDao->findByEmail($email)){
        $_SESSION["flash"] = "Email Já Cadastrado";
        header("Location: ".$base."/cadastro");
        exit;
    }

    if($UsuarioDao->findByName($usuario)){
        $_SESSION["flash"] = "Usuário Já Cadastrado";
        header("Location: ".$base."/cadastro");
        exit;
    }

    if($password != $confirmPassword){
        $_SESSION["flash"] = "As senhas não batem";
        header("Location: ".$base."/cadastro");
        exit;
    }

    $Auth->registerUser($email,$usuario, $password);
    $to = $email;
    $subject = "bem vindo ao DEVMUSIC";
    $message = "Bem vindo a nossa plataforma DEVMUSIC";

    if(mail($to, $subject, $message, $headers)) {
        echo "Email enviado com sucesso!";
    } else {
        echo "Falha ao enviar o email.";
    }


    $_SESSION["flash"] = "Usuário cadastrado com Sucesso";
    header("Location: ".$base);
    exit;
}

$_SESSION["flash"] = "Preencha Todos os Dados Corretamente";
header("Location: ".$base."/cadastro");
exit;


?>