<?php

use app\Dao\MusicDaoMysql;
use app\Models\Auth;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php"; 

$path = __DIR__ . "\..";
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

require_once "../config/config.php"; 

$Auth = new Auth($pdo, $base);
$userInfo = $Auth->checkToken();

$MusicDao = new MusicDaoMysql($pdo);
$data = $MusicDao->findAll();
$dataArtist = $MusicDao->findAllArtistas();


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
    
        <?php foreach($dataArtist as $item):?>
            <a href="<?= $base?>/search?query=<?= htmlspecialchars($item->getArtista())?>" class="banner-produtor">
                <img src="<?= $base?>/media/capas/<?= $item->getCapa()?>" alt="" />
                <p><?= strlen($item->getArtista()) > 15 ? substr($item->getArtista(), 0, 15)."..." : $item->getArtista() ; ?></p>    
            </a>
        <?php endforeach;?>
    </div>
</section>

<?php include "../partials/footer.php"?>