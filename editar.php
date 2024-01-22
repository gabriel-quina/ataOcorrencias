<?php

//#composer require __DIR__. '/vendor/autoload.php'
require __DIR__. '/app/Entity/Ocorrencia.php';
require __DIR__. '/app/Entity/Autorizacoes.php';
require __DIR__. '/app/Entity/Condominio.php';
require __DIR__. '/app/Entity/Usuario.php';
require __DIR__. '/app/Db/Database.php';
require __DIR__. '/app/Session/Login.php';

use App\Entity\Autorizacoes;
use App\Entity\Ocorrencia;
use App\Entity\Condominio;
use App\Entity\Usuario;
use App\Session\Login;

Login::requireLogin();

$alertaCadastro = '';

date_default_timezone_set('America/Sao_Paulo');

$condominios = Condominio::getCondominios(null, null, 'nome_condominio', null);

$obCondominio = Condominio::getCondominio($_GET['id']);
$obOcorrencia = Ocorrencia::getOcorrencia($_GET['id']);
$obAutorizacao = Autorizacoes::getAutorizacao($_GET['id']);
$obUsuario = Usuario::getUsuarioPorId($_GET['id']);

if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?'.$_GET['page'].'status=error');
    exit;
}

include __DIR__. '/includes/header.php';
switch ($_GET['page']) {
    case "condominio":
        if(!$obCondominio instanceof Condominio) {
            header('location: index.php?'.$_GET['page'].'status=error');
            exit;
        }
        if(isset($_POST['nome_condominio'],$_POST['cod_moni'],$_POST['faixa_ip'])) {

            $obCondominio->nome_condominio = $_POST['nome_condominio'];
            $obCondominio->cod_moni = $_POST['cod_moni'];
            $obCondominio->faixa_ip = $_POST['faixa_ip'];
            $obCondominio->tipoatendimento = $_POST['tipoatendimento'];
            $obCondominio->atualizar();
            header('location: index.php?page=condominio&status=success');
            exit;
        }
        include __DIR__. '/includes/formulario-condominio.php';
        break;
    case "usuario":
        if(!$obUsuario instanceof Usuario) {
            header('location: index.php?'.$_GET['page'].'status=error');
            exit;
        }
        if(isset($_POST['nome'],$_POST['nivelacesso'])) {

            $obUsuario->nome = $_POST['nome'];
            if (strlen($_POST['senha'])) {
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            }
            $obUsuario->nivelacesso = $_POST['nivelacesso'];
            $obUsuario->atualizar();
            header('location: index.php?page=usuario&status=success');
            exit;
        }
        include __DIR__. '/includes/formulario-cadastro.php';
        break;
    case "ata":
        if(!$obOcorrencia instanceof Ocorrencia) {
            header('location: index.php?'.$_GET['page'].'status=error');
            exit;
        }
        if(isset($_POST['condominio'],$_POST['ocorrencia'],$_POST['tipo_ocorrencia'],$_POST['statusOcorrencia'])) {
          
          $info_condominio = explode('|', $_POST['condominio']);

          $obOcorrencia->id_condominio = $info_condominio[0];
          $obOcorrencia->condominio = $info_condominio[1];
          $obOcorrencia->ocorrencia = $_POST['ocorrencia'];
          $obOcorrencia->tipo_ocorrencia = $_POST['tipo_ocorrencia'];
          
          $obOcorrencia->status= $_POST['statusOcorrencia'];
          $obOcorrencia->atualizar();

          header('Location: index.php?page=ata&status=success');
          exit;
        }
        include __DIR__. '/includes/formulario.php';
        break;
    case "autorizacoes":
      if(!$obAutorizacao instanceof Autorizacoes) {
          header('location: index.php?'.$_GET['page'].'status=error');
          exit;
      }
      if(isset($_POST['condominio'],$_POST['autorizacao'],$_POST['data_inicio'],$_POST['data_fim'])) {
        
        $info_condominio = explode('|', $_POST['condominio']);

        $obAutorizacao->id_condominio = $info_condominio[0];
        $obAutorizacao->condominio = $info_condominio[1];
        $obAutorizacao->autorizacao = $_POST['autorizacao'];
        $obAutorizacao->data_inicio = $_POST['data_inicio'];
        if ($_POST['data_fim'] == "") {
            $obAutorizacao->data_fim = date('Y-m-d', strtotime('Dec 31'));
        } else {
            $obAutorizacao->data_fim = $_POST['data_fim'];
        }
        $obAutorizacao->atualizar();

        header('Location: index.php?page=autorizacoes&status=success');
        exit;
      }
      include __DIR__. '/includes/formulario-autorizacao.php';
      break;
};
include __DIR__. '/includes/footer.php';
