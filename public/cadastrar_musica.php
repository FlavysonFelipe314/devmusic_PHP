<?php

use app\Dao\CategoriaDaoMysql;
use app\Models\Auth;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php"; 

$path = __DIR__ . "\..";
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

require_once "../config/config.php"; 

$Auth = new Auth($pdo, $base);
$userInfo = $Auth->checkToken();

$CategoriaDao = new CategoriaDaoMysql($pdo);
$data = $CategoriaDao->findAll();

include "../partials/header.php";
?>
<section class="musics">
    <div class="add-recent">
    <div class="title">
        <div class="text">
        <span class="material-symbols-outlined"> home </span>
        <h1>Cadastrar Musica</h1>
        </div>
    </div>
    </div>

    <form action="<?= $base?>/cadastrar_musica_action" method="POST" enctype="multipart/form-data" style="color:white;">
    <?php
        if(!empty($_SESSION["flash"])){
            echo $_SESSION["flash"];
            $_SESSION["flash"] = "";
        }
    ?>
    <div class="w100-wraper">
        <label for="musica">Musica</label>
        <input type="file" name="musica" id="musica" accept=".mp3">
    </div>
    <div class="w100-wraper">
        <label for="capa">Capa</label>
        <input type="file" name="capa" id="capa" accept="image/png, image/jpg, image/jpeg">
    </div>
    <div class="w100-wraper">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo">
    </div>
    <div class="w100-wraper">
        <label for="artista">Artista</label>
        <input type="text" name="artista" id="artista">
    </div>
    <div class="w100-wraper">
        <label for="categoria">Categoria</label>
        <select name="categoria" id="categoria">
            <?php foreach($data as $item):?>
                <option value="<?= $item->getCategoria()?>"><?= $item->getCategoria()?></option>
            <?php endforeach;?>
        </select>

    </div>
    <div class="submit-wraper">
        <button type="submit">Enviar</button>
    </div>
</form>
</section>

<?php include "../partials/footer.php"?>