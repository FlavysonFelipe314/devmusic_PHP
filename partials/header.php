<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="author_name" />
    <meta name="description" content="description_content" />
    <meta name="keywords" content="your,keywords,here" />

    <title>Document</title>

    <link rel="stylesheet" href="src/styles/global.css" />
    <link rel="stylesheet" href="src/styles/vendor/reset.css" />
    <link rel="stylesheet" href="src/styles/components/musicBar.css" />
    <link rel="stylesheet" href="src/styles/components/menuBar.css" />
    <link rel="stylesheet" href="src/styles/components/search.css" />
    <link rel="stylesheet" href="src/styles/components/title.css" />
    <link rel="stylesheet" href="src/styles/components/button.css" />
    <link rel="stylesheet" href="src/styles/components/input.css" />
    <link rel="stylesheet" href="src/styles/components/form.css" />
    <link rel="stylesheet" href="src/styles/components/musicSingle.css" />
    <link rel="stylesheet" href="src/styles/components/cadastrarBox.css" />
    <link rel="stylesheet" href="src/styles/layouts/home.css" />
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
    <aside id="lateral-menu-desktop">
      <div class="container">
        <div class="top-menu">
          <div class="logo">
            <img src="<?= $base?>/src/assets/images/logo.png" alt="" />
          </div>

          <nav>
            <a href="<?= $base?>/">
              <span class="material-symbols-outlined"> home </span>
              Inicio
            </a>
            <a href="<?= $base?>/suasMusicas">
              <span class="material-symbols-outlined"> music_note </span>
              Suas Músicas
            </a>
            <a href="<?= $base?>/categorias">
              <span class="material-symbols-outlined">
                format_list_bulleted
              </span>
              Categorias
            </a>
            <a href="<?= $base?>/artistas">
              <span class="material-symbols-outlined"> mic </span>
              Artistas
            </a>
          </nav>
        </div>

        <nav class="down-menu">
          <a href="<?= $base?>/logout">
            <button>
              <span class="material-symbols-outlined">
                power_settings_new
              </span>
            </button>
          </a>

          <a href="<?= $base?>/perfil">
            <button>
              <span class="material-symbols-outlined"> settings </span>
            </button>
          </a>

          <div id="cadastrar-trigger">
            <div class="cadastrar-box" id="cadastrar-box">
              <a href="<?= $base?>/cadastrar_musica"> <span class="material-symbols-outlined">add</span> Adicionar Música</a><br>
              <a href="<?= $base?>/cadastrar_categoria"> <span class="material-symbols-outlined">add</span> Adicionar Categoria</a>
            </div>
            <button>
              <span class="material-symbols-outlined"> add_circle </span>
            </button>
          </div>
        </nav>
      </div>
    </aside>

    <aside id="lateral-menu-mobile">
      <div class="container">
        <div class="top-menu">
          <div class="logo">
            <img src="<?= $base?>/src/assets/images/logo.png" alt="" />
            <span id="trigger-close" class="material-symbols-outlined"
              >close</span
            >
          </div>
          <form action="<?= $base?>/search" method="GET" id="search-bar">
            <input type="search" placeholder="Pesquisar..." name="query"/>

            <button>
              <span class="material-symbols-outlined"> search </span>
            </button>
          </form>

          <nav>
            <a href="<?= $base?>/">
              <span class="material-symbols-outlined"> home </span>
              Inicio
            </a>
            <a href="<?= $base?>/suasMusicas">
              <span class="material-symbols-outlined"> music_note </span>
              Suas Músicas
            </a>
            <a href="<?= $base?>/categorias">
              <span class="material-symbols-outlined">
                format_list_bulleted
              </span>
              Categorias
            </a>
            <a href="<?= $base?>/artistas">
              <span class="material-symbols-outlined"> mic </span>
              Artistas
            </a>
          </nav>
        </div>

        <nav class="down-menu">
          <a href="<?= $base?>/logout">
            <button>
              <span class="material-symbols-outlined">
                power_settings_new
              </span>
            </button>
          </a>

          <a href="<?= $base?>/perfil">
            <button>
              <span class="material-symbols-outlined"> settings </span>
            </button>
          </a>

          <div id="cadastrar-trigger-mobile">
            <div class="cadastrar-box" id="cadastrar-c-mobile">
              <a href="<?= $base?>/cadastrar_musica"> <span class="material-symbols-outlined">add</span> Adicionar Música</a><br>
              <a href="<?= $base?>/cadastrar_categoria"> <span class="material-symbols-outlined">add</span> Adicionar Categoria</a>
            </div>
            <button>
              <span class="material-symbols-outlined"> add_circle </span>
            </button>
          </div>
        </nav>
      </div>
    </aside>

    <aside id="content-body">
      <div class="container">
        <header id="header-desktop">
          <div id="trigger-hidden">
            <span class="material-symbols-outlined"> menu </span>
          </div>

          <form action="<?= $base?>/search" method="GET" id="search-bar">
            <input type="search" placeholder="Pesquisar..." name="query"/>

            <button type="submit">
              <span class="material-symbols-outlined"> search </span>
            </button>
          </form>

          <a href="<?= $base?>/perfil" class="perfil-user">
            <img src="<?= $base?>/media/avatars/<?= $userInfo->getAvatar()?>" alt="" />
          </a>
        </header>

        <header id="header-mobile">
          <div class="logo">
            <img src="<?= $base?>/src/assets/images/logo.png" alt="" />
          </div>
          <div id="trigger-open">
            <span class="material-symbols-outlined"> menu </span>
          </div>
        </header>