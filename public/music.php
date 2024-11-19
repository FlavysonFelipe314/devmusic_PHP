<?php

use app\Dao\MusicDaoMysql;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php"; 

$path = __DIR__ . "\..";
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

require_once "../config/config.php"; 

$MusicDao = new MusicDaoMysql($pdo);
$data = $MusicDao->findByid("1");

echo "<pre>";
print_r($data);
?>