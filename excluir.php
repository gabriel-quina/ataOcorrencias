<?php

    //#composer require __DIR__. '/vendor/autoload.php'
    require __DIR__. '/app/Entity/Ocorrencia.php';
    require __DIR__. '/app/Entity/Condominio.php';
    require __DIR__. '/app/Entity/Autorizacoes.php';
    require __DIR__. '/app/Entity/Usuario.php';
    require __DIR__. '/app/Db/Database.php';
    require __DIR__. '/app/Session/Login.php';

    use \App\Entity\Ocorrencia;
    use \App\Entity\Condominio;
    use \App\Entity\Autorizacoes;
    use \App\Entity\Usuario;
    use \App\Session\Login;

    Login::requireLogin();

    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
        header('location: index.php?page='.$_GET['page'].'status=error');
        exit;
    }

    $obCondominio = Condominio::getCondominio($_GET['id']);
    $obOcorrencia = Ocorrencia::getOcorrencia($_GET['id']);
    $obAutorizacao = Autorizacoes::getAutorizacao($_GET['id']);
    $obUsuario = Usuario::getUsuarioPorId($_GET['id']);
    
    switch ($_GET['page']) {
        case 'ata':
            if(!$obOcorrencia instanceof Ocorrencia){
                header('location: index.php?page='.$_GET['page'].'&status=error');
                exit;
            }
            if(isset($_POST['excluir'])){
                $obOcorrencia->excluir();
        
                header('location: index.php?page='.$_GET['page'].'&status=success');
                exit;
            }
            break;
        case 'autorizacoes':
            if(!$obAutorizacao instanceof Autorizacoes){
                header('location: index.php?page='.$_GET['page'].'&status=error');
                exit;
            }
            if(isset($_POST['excluir'])){
                $obAutorizacao->excluir();
        
                header('location: index.php?page='.$_GET['page'].'&status=success');
                exit;
            }
            break;
        case 'condominio':
            if(!$obCondominio instanceof Condominio){
                header('location: index.php?page='.$_GET['page'].'&status=error');
                exit;
            }
            if(isset($_POST['excluir'])){
                $obCondominio->excluir();
        
                header('location: index.php?page='.$_GET['page'].'&status=success');
                exit;
            }
            break;
        case 'usuario':
            if(!$obUsuario instanceof Usuario){
                header('location: index.php?page='.$_GET['page'].'&status=error');
                exit;
            }
            if(isset($_POST['excluir'])){
                $obUsuario->excluir();
        
                header('location: index.php?page='.$_GET['page'].'&status=success');
                exit;
            }
            break;
    };    

    include __DIR__. '/includes/header.php';
    include __DIR__. '/includes/confirmar-exclusao.php';
    include __DIR__. '/includes/footer.php';
    
?>