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

include "../partials/header.php";
?>
<section class="musics">
    <div class="add-recent">
    <div class="title">
        <div class="text">
        <span class="material-symbols-outlined"> home </span>
        <h1>Editar Perfil</h1>
        </div>
    </div>
    </div>

    <form action="<?= $base?>/configuracoes_action" method="POST" enctype="multipart/form-data" style="color:white;">
    <?php
        if(!empty($_SESSION["flash"])){
            echo $_SESSION["flash"];
            $_SESSION["flash"] = "";
        }
    ?>
    <div class="w100-wraper">
        <label for="perfil">Foto de Perfil</label>
        <input type="file" name="perfil" id="perfil">
    </div>
    <div class="w100-wraper">
        <label for="usuario">Usuário</label>
        <input type="text" name="usuario" id="usuario" value="<?= $userInfo->getUsuario()?>">
    </div>
    <div class="w100-wraper">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $userInfo->getEmail()?>" >
    </div>
    <div class="w100-wraper">
        <label for="password">Senha</label>
        <input
        type="password"
        name="password"
        id="password"
        />
    </div>
    <div class="w100-wraper">
        <label for="confirmPassword">Confirmar Senha</label>
        <input
        type="password"
        name="confirmPassword"
        id="confirmPassword"
        />
    </div>

    <div class="submit-wraper">
        <button type="submit">Enviar</button>
    </div>
</form>
</section>

<?php include "../partials/footer.php"?>