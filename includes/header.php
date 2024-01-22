<?php

use App\Session\Login;

$usuarioLogado = Login::getUsuarioLogado();

?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATA Ocorrencias - Castseg</title>
    <link rel="preload" as="font" href="/fonts/bootstrap-icons.woff2" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="/fonts/bootstrap-icons.woff" type="font/woff2" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/bootstrap-icons.css" rel="stylesheet" crossorigin="anonymous">
    <link href="css/custom.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono&display=swap" rel="stylesheet">
    <link rel="icon" href="img/cropped-flaticon-32x32.png" sizes="32x32" />
    <link rel="icon" href="img/cropped-flaticon-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="img/cropped-flaticon-180x180.png" />
    <meta name="msapplication-TileImage" content="img/cropped-flaticon-270x270.png" />
  </head>
  <body class="bg-dark bg-gradient text-light d-flex flex-nowrap flex-column">
      <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" target="_blank" href="https://castsegjuizdefora.com.br/">
              <img src="img/castseg.png" alt="" height="35">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav me-auto">
                <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'ata' ? 'active' : ' ' ?>" <?= $usuarioLogado == null ? 'hidden' : ' ' ?> aria-current="page" href="index.php?page=ata">Ocorrencias</a>
                <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'autorizacoes' ? 'active' : ' ' ?>" <?= $usuarioLogado == null ? 'hidden' : ' ' ?> href="index.php?page=autorizacoes">Autorizações</a>
                <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'condominio' ? 'active' : ' ' ?>" <?= $usuarioLogado == null ? 'hidden' : ' ' ?> href="index.php?page=condominio">Cadastro Condominios</a>
                <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'usuario' ? 'active' : ' ' ?>" <?= $usuarioLogado == null ? 'hidden' : ' ' ?> href="index.php?page=usuario">Cadastro Usuarios</a>
                <a class="nav-link" <?= $usuarioLogado == null ? 'hidden' : ' ' ?> href="logout.php">| Logout |</a>
              </div>
              <div class="navbar-nav" <?= $usuarioLogado == null ? 'hidden' : ' ' ?>>
                <a class="nav-link" <?= $usuarioLogado == null ? 'hidden' : ' ' ?> target="_blank" href="repo/pdfs/HOR%c3%81RIOS%20DE%20DESCOMPRESS%c3%83O.pdf">Horarios Descompressão</a>
                <a class="nav-link" <?= $usuarioLogado == null ? 'hidden' : ' ' ?> target="_blank" href="repo/pdfs/Manual%20do%20Operador%20de%20Monitoramento.pdf">Manual do Operador</a>
                <span class="navbar-text">| Seja bem vindo <strong><a <?= $usuarioLogado == null ? 'hidden' : ' ' ?> class="text-capitalize" href="editarusuario.php"><?=$usuarioLogado['nome']?></a></strong></span>
              </div>     
            </div>
          </div>
        </nav>
      </header>
        
     