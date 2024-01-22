<?php

require __DIR__. '/app/Entity/Ocorrencia.php';
require __DIR__. '/app/Entity/Condominio.php';
require __DIR__. '/app/Entity/Usuario.php';
require __DIR__. '/app/Db/Database.php';
require __DIR__. '/app/Db/Pagination.php';
require __DIR__. '/app/Session/Login.php';

use \App\Entity\Usuario;
use \App\Session\Login;

Login::requireLogin();

date_default_timezone_set('America/Sao_Paulo');

$obUsuario = Usuario::getUsuarioPorId($_SESSION['usuario']['id']);

if(!$obUsuario instanceof Usuario) {
  header('location: index.php?'.$_GET['page'].'status=error');
  exit;
}

if(isset($_POST['senha'],$_POST['novasenha'],$_POST['confirmasenha'])) {
  if ($_POST['novasenha'] != $_POST['confirmasenha'] || !password_verify($_POST['senha'],$obUsuario->senha)) {
    header('location: editarusuario.php?status=errorPassword');
    exit;
  }
  $obUsuario->senha = password_hash($_POST['novasenha'], PASSWORD_DEFAULT);
  $obUsuario->atualizar();
  header('location: editarusuario.php?status=success');
  exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario-usuario.php';
include __DIR__.'/includes/footer.php';