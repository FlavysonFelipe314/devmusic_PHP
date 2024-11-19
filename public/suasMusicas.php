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

$query = filter_input(INPUT_GET, "query");

$MusicDao = new MusicDaoMysql($pdo);
$data = $MusicDao->findByidUser($userInfo->getId());

include "../partials/header.php";
?>



<section class="musics">
    <div class="title">
        <div class="text">
        <span class="material-symbols-outlined"> home </span>
        <h1>Suas Músicas</h1>
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
        <?php endforeach;}else{echo "<p style='color:white;'>não há músicas para Mostrar...</p>";}?>
    </div>
</section>

<?php include "../partials/footer.php"?>