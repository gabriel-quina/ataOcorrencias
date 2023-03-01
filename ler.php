<?php

    //#composer require __DIR__. '/vendor/autoload.php'
    require __DIR__. '/app/Entity/Ocorrencia.php';
    require __DIR__. '/app/Entity/Condominio.php';
    require __DIR__. '/app/Entity/Usuario.php';
    require __DIR__. '/app/Db/Database.php';
    require __DIR__. '/app/Session/Login.php';

    use \App\Entity\Ocorrencia;
    use \App\Session\Login;

    Login::requireLogin();

    date_default_timezone_set('America/Sao_Paulo');

    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
        header('location: index.php?page='.$_GET['page'].'status=error');
        exit;
    }

    $where = '';
    $where .= 'id_ocorrencias = '. $_GET['id'] .' AND id_usuario = '.$_SESSION['usuario']['id'].'';

    $obOcorrencia = Ocorrencia::getOcorrenciasLidas(null, $where);

    if(empty(!$obOcorrencia)){
        header('location: index.php?page=ata&status=error');
        exit;
      }else{    
        Ocorrencia::ler($_GET['id'],$_SESSION['usuario']['id'],date('Y-m-d H:i:s'));
    }

    header('location: index.php?page=ata&status=success');
    exit;

?>