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

// echo "<pre>";
// print_r($userInfo);
// exit;

$MusicDao = new MusicDaoMysql($pdo);
$data = $MusicDao->findAll();
$dataArtist = $MusicDao->findAllArtistas();


include "../partials/header.php";
?>
<section class="produtores">
<?php
            if(!empty($_SESSION["flash"])){
                echo $_SESSION["flash"];
                $_SESSION["flash"] = "";
            }
        ?>
    <div class="title">
    <div class="text">
        <span class="material-symbols-outlined"> home </span>
        <h1>Principais Artistas</h1>
    </div>

    <div class="controls">
        <button id="scroll-left">
        <span class="material-symbols-outlined"> chevron_left </span>
        </button>
        <button id="scroll-right">
        <span class="material-symbols-outlined"> chevron_right </span>
        </button>
    </div>
    </div>

    <div class="banner-content">
    
        <?php foreach($dataArtist as $item):?>
            <a href="" class="banner-produtor">
                <img src="<?= $base?>/media/capas/<?= $item->getCapa()?>" alt="" />
                <p><?= strlen($item->getArtista()) > 15 ? substr($item->getArtista(), 0, 15)."..." : $item->getArtista() ; ?></p>    
            </a>
        <?php endforeach;?>

    </div>
</section>

<section class="musics">
    <div class="add-recent">
    <div class="title">
        <div class="text">
        <span class="material-symbols-outlined"> home </span>
        <h1>Adicionados Recentemente</h1>
        </div>
    </div>
    </div>

    <div class="music-content">
        <?php if($data){foreach($data as $item):?>
            <div class="music-single" id="<?=$item->getId()?>">
            <div class="side-one">
                <img src="<?= $base?>/media/capas/<?= $item->getCapa();?>" alt="" />
                <div class="text">
                <h2><?= $item->getTitle();?></h2>
                <h3><?= $item->getArtista();?></h3>
                </div>
            </div>
            <span class="material-symbols-outlined"> more_vert </span>
            </div>
        <?php endforeach;}?>
    </div>
</section>

<?php include "../partials/footer.php"?>