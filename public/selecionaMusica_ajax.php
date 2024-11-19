<?php

use app\Dao\MusicDaoMysql;
use app\Models\Music;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php"; 

$path = __DIR__ . "\..";
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

require_once "../config/config.php"; 

$MusicDao = new MusicDaoMysql($pdo);

$array = [];

$id = filter_input(INPUT_GET, "id");

$musicItem = $MusicDao->findByid($id);

$audio =  $musicItem->getMusic();
$capa =  $musicItem->getCapa();
$titulo =  $musicItem->getTitle();
$artista =  $musicItem->getArtista();

$array = [
    'error' => '',
    'audio' => "$audio",
    'capa' => "$capa",
    'titulo' => "$titulo",
    'artista' => "$artista",
];


header("Content-type: application/json");
echo json_encode($array);
exit;