<?php

require __DIR__. '/app/Entity/Ocorrencia.php';
require __DIR__. '/app/Entity/Condominio.php';
require __DIR__. '/app/Entity/Usuario.php';
require __DIR__. '/app/Db/Database.php';
require __DIR__. '/app/Db/Pagination.php';
require __DIR__. '/app/Session/Login.php';

use \App\Entity\Usuario;
use \App\Session\Login;

Login::requireLogout();

$alertaLogin = '';
$alertaCadastro = '';

if(isset($_POST['acao'])){

      $obUsuario = Usuario::getUsuarioPorNome($_POST['nome']);

      if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'],$obUsuario->senha)){
        $alertaLogin = 'Usuario ou senha inválidos';
      }else{      
      Login::login($obUsuario);
      }

}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario-login.php';
include __DIR__.'/includes/footer.php';