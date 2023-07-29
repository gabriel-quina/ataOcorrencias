<?php

require __DIR__. '/vendor/autoload.php';

/*
require __DIR__. '/app/Entity/Ocorrencia.php';
require __DIR__. '/app/Entity/Condominio.php';
require __DIR__. '/app/Entity/Usuario.php';
require __DIR__. '/app/Db/Database.php';
require __DIR__. '/app/Db/Pagination.php';
require __DIR__. '/app/Session/Login.php';
*/

use App\Entity\Usuario;
use App\Session\Login;

$alertaLogin = '';
$alertaCadastro = '';

if(isset($_POST['acao'])) {
    if(isset($_POST['nome'],$_POST['senha'],$_POST['acesso'])) {

        $obUsuario = Usuario::getUsuarioPorNome($_POST['nome']);
        if($obUsuario instanceof Usuario) {
            $alertaCadastro = 'O usuario digitado já está em uso';
        } else {

            $obUsuario = new Usuario();
            $obUsuario->nomeDeUsuario = $_POST['nome'];
            $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $obUsuario->nivelAcesso = $_POST['acesso'];
            $obUsuario->cadastrar();

            Login::login($obUsuario);
        }
    }
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario-cadastro.php';
include __DIR__.'/includes/footer.php';
