<?php

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

    <form action="<?= $base?>/cadastrar_categoria_action" method="POST" enctype="multipart/form-data">
        <?php
            if(!empty($_SESSION["flash"])){
                echo $_SESSION["flash"];
                $_SESSION["flash"] = "";
            }
        ?>
        <div class="w100-wraper">
            <label for="categoria" style="color: white;">Categoria</label>
            <input type="text" name="categoria" id="categoria">
        </div>
        <div class="submit-wraper">
            <button type="submit">Enviar</button>
        </div>
    </form>

<?php include "../partials/footer.php"?>