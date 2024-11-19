<?php

use app\Dao\CategoriaDaoMysql;
use app\Models\Auth;
use app\Models\Categoria;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php"; 

$path = __DIR__ . "\..";
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

require_once "../config/config.php"; 

$Auth = new Auth($pdo, $base);
$userInfo = $Auth->checkToken();

$CategoriaDao = new CategoriaDaoMysql($pdo);
$Categoria = new Categoria();

$categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if($categoria){
    $Categoria->setCategoria($categoria);
    $CategoriaDao->create($Categoria);

    $_SESSION["flash"] = "Categoria Cadastrada com Sucesso";
    header("Location: ".$base);
    exit;
}

$_SESSION["flash"] = "Preencha o Campo Corretamente";
header("Location: ".$base."/cadastrar_categoria");
exit;


?>