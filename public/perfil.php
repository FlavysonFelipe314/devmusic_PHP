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
$data = $MusicDao->findByidUser($userInfo->getId());


include "../partials/header.php";
?>
<head>
    <style>
        section.perfil{
            display: flex;
            align-items: center;
        }

        section.perfil img{
            width: 150px;
            border-radius: 200px;
        }

        section.perfil .info-perfil{
            width: 100%;
            margin: 0 0 0 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-perfil .text-side{
            color: var(--primary-white);
        }

        .text-side h1{
            font-size: 30px;
            font-weight: 400;
            margin: 0 0 10px 0;
            letter-spacing: 3px;
        }

        .text-side h2{
            font-size: 18px;
            font-weight: 400;
            color: var(--primary-lightGray);
            letter-spacing: 3px;
        }

        .option-side button{
            width: 200px !important;
        }

        @media screen and (max-width:1000px){
            section.perfil,
            section.perfil .info-perfil{
                flex-direction: column;
                justify-content: center;
                text-align: center;
                margin: 0;
            }
            .info-perfil .text-side{
                margin: 20px 0 0 0;
            }
            .option-side{
                margin: 40px 0 0 0;
            }
            section.perfil img{
            width: 200px;
        }
        }

        @media screen and (max-width:1000px){
            section.perfil img{
            width: 100px;
        }

        .text-side h1{
            font-size: 25px;
        }

        .text-side h2{
            font-size: 16px;
            font-weight: 400;
            color: var(--primary-lightGray);
            letter-spacing: 3px;
        }
        }
    </style>
</head>
<section class="perfil">
    <div class="img-perfil">
        <img src="<?= $base?>/media/avatars/<?= $userInfo->getAvatar();?>" alt="">
    </div>
    <div class="info-perfil">
        <div class="text-side">
            <h1><?= $userInfo->getUsuario()?></h1>
            <h2><?= $userInfo->getEmail()?></h2>
        </div>
        <div class="option-side">
            <a href="<?= $base?>/configuracoes">
                <button>Editar Perfil</button>
            </a>
        </div>
    </div>
</section>

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