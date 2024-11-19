<?php
use Dotenv\Dotenv;

require_once "../vendor/autoload.php"; 

$path = __DIR__ . "\..";
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

require_once "../config/config.php"; 

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="author_name" />
    <meta name="description" content="description_content" />
    <meta name="keywords" content="your,keywords,here" />

    <title><?= $_ENV["SITE_NAME"]?></title>

    <link rel="stylesheet" href="<?= $base?>/src/styles/global.css" />
    <link rel="stylesheet" href="<?= $base?>/src/styles/vendor/reset.css" />
    <link rel="stylesheet" href="<?= $base?>/src/styles/components/title.css" />
    <link rel="stylesheet" href="<?= $base?>/src/styles/components/button.css" />
    <link rel="stylesheet" href="<?= $base?>/src/styles/components/input.css" />
    <link rel="stylesheet" href="<?= $base?>/src/styles/components/form.css" />
    <link rel="stylesheet" href="<?= $base?>/src/styles/layouts/login.css" />
    <!-- Google Apis -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" hr ef="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />

    <script
      src="https://kit.fontawesome.com/cacd8cf69e.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <section class="formulario">

    <form action="<?= $base?>/cadastro_action" method="post">
        <div class="logo">
            <img src="<?= $base?>/src/assets/images/logo.png" alt="">
        </div>
        <h1>Cadastro</h1>
        <?php
            if(!empty($_SESSION["flash"])){
                echo $_SESSION["flash"];
                $_SESSION["flash"] = "";
            }
        ?>
        <div class="w100-wraper">
            <label for="nome">Usuário</label>
            <input type="text" name="nome" id="nome">
        </div>
        <div class="w100-wraper">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
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
        <button>Cadastrar</button>
      </div>

      <div class="options-wraper">
        <p>Já tem conta? <a href="<?= $base?>/login">Login!</a></p>
      </div>
    </form>
    </section>
  </body>
</html>