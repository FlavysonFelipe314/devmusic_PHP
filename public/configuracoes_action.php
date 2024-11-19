<?php

use app\Dao\UsuarioDaoMysql;
use app\Models\Auth;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php"; 

$path = __DIR__ . "\..";
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

require_once "../config/config.php"; 

$Auth = new Auth($pdo, $base);
$userInfo = $Auth->checkToken();

$UsuarioDao = new UsuarioDaoMysql($pdo);

$usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, "password",);
$confirmPassword = filter_input(INPUT_POST, "confirmPassword",);
$perfil = $_FILES["perfil"];


$acceptPerfil = ["image/png", "image/jpeg", "image/jpg"];

if($email && $usuario){

    if($perfil["size"] != 0){
        if(in_array($perfil["type"], $acceptPerfil)){

            $perfilWidth = 500;
            $perfilHeight = 500;
            
            list($widthOrig, $heightOrig) = getimagesize($perfil["tmp_name"]);
            $ratio = $widthOrig / $heightOrig;
            
            $newWidth = $perfilWidth;
            $newHeight = $newWidth / $ratio;
            
            if ($newHeight < $perfilHeight) {
                $newHeight = $perfilHeight;
                $newWidth = $newHeight * $ratio;
            }
            
            $x = ($perfilWidth - $newWidth) / 2;
            $y = ($perfilHeight - $newHeight) / 2;
            
            $finalImage = imagecreatetruecolor($perfilWidth, $perfilHeight);
            
            switch ($perfil["type"]) {
                case "image/jpeg":
                case "image/jpg":
                    $image = imagecreatefromjpeg($perfil["tmp_name"]);
                    break;
                case "image/png":
                    $image = imagecreatefrompng($perfil["tmp_name"]);
                    break;
            }
            
            imagecopyresampled(
                $finalImage, $image,
                $x, $y, 0, 0,
                $newWidth, $newHeight, $widthOrig, $heightOrig
            );
    
            $perfilName = md5(time().rand(0, 9999).'.jpg');
            
            imagejpeg($finalImage, "media/avatars/".$perfilName, 100);

            $userInfo->setAvatar($perfilName); 
        }else{
            $_SESSION["flash"] = "O arquivo da perfil não corresponde os formatos exigidos";
            header("Location: ".$base."/cadastrar_musica");
            exit;
        }
    }

    if($password != $confirmPassword){
        $_SESSION["flash"] = "As senhas não batem";
        header("Location: ".$base."/configuracoes");
        exit;
    }

    $hash = password_hash($password, PASSWORD_BCRYPT);

    $userInfo->setPassword($hash);
    $userInfo->setUsuario($usuario);
    $userInfo->setEmail($email);
    $UsuarioDao->update($userInfo);

    $_SESSION["flash"] = "Usuario atualizado com Sucesso";
    header("Location: ".$base);
    exit;
}

$_SESSION["flash"] = "Preencha Todos os Dados Corretamente";
header("Location: ".$base."/configuracoes");
exit;


?>