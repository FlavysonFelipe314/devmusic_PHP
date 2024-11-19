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
<section class="produtores">
    <div class="title">
    <div class="text">
        <span class="material-symbols-outlined"> home </span>
        <h1>Artistas</h1>
    </div>

    <style>
        .banner-artist {
            flex-wrap: wrap;
        }

        section.produtores .banner-produtor {
            margin: 0;
            width: 20% !important;
            padding: 10px !important;
        }

        section.produtores .banner-produtor img{
            width: 100%;
            height: auto;
        }

        @media screen and (max-width: 500px){
            section.produtores .banner-produtor {
            width: 50% !important;
        }
        }
    </style>
    </div>

    <div class="banner-content banner-artist">
    
        <?php foreach($data as $item):?>
            <a href="<?= $base?>/search?query=<?= $item->getCategoria()?>" class="banner-produtor">
                <img src="<?= $base?>/src/assets/images/default.png" alt="" />
                <p><?= strlen($item->getCategoria()) > 15 ? substr($item->getCategoria(), 0, 15)."..." : $item->getCategoria() ; ?></p>    
            </a>
        <?php endforeach;?>
    </div>
</section>

<?php include "../partials/footer.php"?>