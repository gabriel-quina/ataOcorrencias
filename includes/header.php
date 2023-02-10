<?php

  use \App\Session\Login;

  $usuarioLogado = Login::getUsuarioLogado();

  $usuario = $usuarioLogado ?
              '<a href="logout.php" class="nav-link">| Logout |</a></div><div class="navbar-nav"><span class="navbar-text">Seja bem vindo <strong>'.$usuarioLogado['nome'].'</strong></span></div>':
              '</div><div class="navbar-nav navbar-text">Visitante</div>';

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
                <a class="nav-link active" aria-current="page" href="index.php?page=ata">Ata</a>
                <a class="nav-link" href="index.php?page=condominio">Cadastro Condominios</a>
                <a class="nav-link disabled" tabindex="-1" href="index.php?page=usuario">Cadastro Usuarios</a>
                <!--<?=$usuario?>-->           
            </div>
          </div>
        </nav>
      </header>
        
     