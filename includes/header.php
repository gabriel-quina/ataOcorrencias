<?php

  use \App\Session\Login;

  $usuarioLogado = Login::getUsuarioLogado();

?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATA Ocorrencias - Castseg</title>
    <link rel="preload" as="font" href="fonts/bootstrap-icons.woff2" type="font/woff2">
    <link rel="preload" as="font" href="fonts/bootstrap-icons.woff" type="font/woff2">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="img/cropped-flaticon-32x32.png" sizes="32x32" />
    <link rel="icon" href="img/cropped-flaticon-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="img/cropped-flaticon-180x180.png" />
    <meta name="msapplication-TileImage" content="img/cropped-flaticon-270x270.png" />
  </head>
  <body class="bg-dark bg-gradient text-light">
      <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" target="blanc" href="https://castsegjuizdefora.com.br/">
              <img src="img/castseg.png" alt="" height="35">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav me-auto">
                <a class="nav-link active" <?= $usuarioLogado == null ? 'hidden' : '' ?> aria-current="page" href="index.php?page=ata">Ata</a>
                <a class="nav-link" <?= $usuarioLogado == null ? 'hidden' : '' ?> href="index.php?page=condominio">Cadastro Condominios</a>
                <a class="nav-link" <?= $usuarioLogado == null ? 'hidden' : '' ?> href="index.php?page=usuario">Cadastro Usuarios</a>
                <a class="nav-link" <?= $usuarioLogado == null ? 'hidden' : '' ?> href="logout.php">| Logout |</a>
              </div>
              <div class="navbar-nav" <?= $usuarioLogado == null ? 'hidden' : '' ?>>
                <span class="navbar-text">Seja bem vindo <strong><?=$usuarioLogado['nome']?></strong></span>
              </div>     
            </div>
          </div>
        </nav>
      </header>
        
     