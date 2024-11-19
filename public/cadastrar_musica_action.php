<?php

use app\Dao\MusicDaoMysql;
use app\Models\Auth;
use app\Models\Music;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php"; 

$path = __DIR__ . "\..";
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

require_once "../config/config.php"; 

$Auth = new Auth($pdo, $base);
$userInfo = $Auth->checkToken();

$MusicDao = new MusicDaoMysql($pdo);
$Music = new Music;

$titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$artista = filter_input(INPUT_POST, "artista", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$categoria = filter_input(INPUT_POST, "categoria");
$music = $_FILES["musica"];
$capa = $_FILES["capa"];

$acceptAudio = ["audio/mp3", "audio/ogg", "audio/mpeg"];
$acceptCapa = ["image/png", "image/jpeg", "image/jpg"];

if($titulo && $music && $capa){

    if(in_array($music["type"], $acceptAudio)){
        $newNameMusic = md5(time().rand(0, 9999)).".mp3";
        move_uploaded_file($music["tmp_name"], "media/music/".$newNameMusic);
    }else{
        $_SESSION["flash"] = "O arquivo de Audio não corresponde os formatos exigidos";
        header("Location: ".$base."/cadastrar_musica");
        exit;
    }

    if(in_array($capa["type"], $acceptCapa)){

        $capaWidth = 500;
        $capaHeight = 500;
        
        list($widthOrig, $heightOrig) = getimagesize($capa["tmp_name"]);
        $ratio = $widthOrig / $heightOrig;
        
        $newWidth = $capaWidth;
        $newHeight = $newWidth / $ratio;
        
        if ($newHeight < $capaHeight) {
            $newHeight = $capaHeight;
            $newWidth = $newHeight * $ratio;
        }
        
        $x = ($capaWidth - $newWidth) / 2;
        $y = ($capaHeight - $newHeight) / 2;
        
        $finalImage = imagecreatetruecolor($capaWidth, $capaHeight);
        
        switch ($capa["type"]) {
            case "image/jpeg":
            case "image/jpg":
                $image = imagecreatefromjpeg($capa["tmp_name"]);
                break;
            case "image/png":
                $image = imagecreatefrompng($capa["tmp_name"]);
                break;
        }
        
        imagecopyresampled(
            $finalImage, $image,
            $x, $y, 0, 0,
            $newWidth, $newHeight, $widthOrig, $heightOrig
        );

        $capaName = md5(time().rand(0, 9999).'.jpg');
        
        imagejpeg($finalImage, "media/capas/".$capaName, 100);

    }else{
        $_SESSION["flash"] = "O arquivo da capa não corresponde os formatos exigidos";
        header("Location: ".$base."/cadastrar_musica");
        exit;
    }

    $Music->setTitle($titulo);
    $Music->setMusic($newNameMusic);
    $Music->setCapa($capaName);
    $Music->setArtista($artista);
    $Music->setCategoria($categoria);
    $Music->setIdUser($userInfo->getId());
    $MusicDao->create($Music);

    $_SESSION["flash"] = "Musica Cadastrada com Sucesso";
    header("Location: ".$base);
    exit;
}

$_SESSION["flash"] = "Preencha Todos os Dados Corretamente";
header("Location: ".$base."/cadastrar_musica");
exit;


?>