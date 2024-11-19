<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

$base = $_ENV["BASE"];
$baseDir = $_ENV["BASE_DIR"];

$db_host = $_ENV["DB_HOST"];
$db_name = $_ENV["DB_NAME"];
$db_user = $_ENV["DB_USER"];
$db_password = $_ENV["DB_PASSWORD"];

$pdo = new PDO("mysql:host=".$db_host.";dbname=".$db_name, $db_user, $db_password);
