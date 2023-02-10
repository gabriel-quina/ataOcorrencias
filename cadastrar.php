<?php

    //#composer require __DIR__. '/vendor/autoload.php'
    require __DIR__. '/app/Entity/Ocorrencia.php';
    require __DIR__. '/app/Entity/Condominio.php';
    require __DIR__. '/app/Db/Database.php';
    require __DIR__. '/app/Session/Login.php';

    define('TITLE','Cadastrar');

    use \App\Entity\Ocorrencia;
    use \App\Entity\Condominio;
    use \App\Session\Login;

    //Login::requireLogin();

    date_default_timezone_set('America/Sao_Paulo');

    $condominios = Condominio::getCondominios(null,'nome_condominio',null);

    $obOcorrencia = new Ocorrencia;
    $obCondominio = new Condominio;

    include __DIR__. '/includes/header.php';
    switch ($_GET['page']) {
        case "condominio":
            if(isset($_POST['nome_condominio'],$_POST['cod_moni'])){
                
                $obCondominio->nome_condominio = $_POST['nome_condominio'];
                $obCondominio->cod_moni = $_POST['cod_moni'];
                $obCondominio->cadastrar();
                
                header('location: index.php?page=condominio&status=success');
                exit;                
            }
            include __DIR__. '/includes/formulario-condominio.php';
            break;
        case "usuario":
            include __DIR__. '/includes/formulario-usuario.php';
            break;
        case "ata": 
            if(isset($_POST['condominio'],$_POST['ocorrencia'],$_POST['data_inicio'],$_POST['data_fim'],$_POST['statusOcorrencia'])){
                
                $obOcorrencia->condominio = $_POST['condominio'];
                $obOcorrencia->ocorrencia = $_POST['ocorrencia'];
                $obOcorrencia->data_inicio = $_POST['data_inicio'];
                $obOcorrencia->data_fim = $_POST['data_fim'];
                $obOcorrencia->status = $_POST['statusOcorrencia'];
                $obOcorrencia->cadastrar();
                header('location: index.php?page=ata&status=success');
                exit;                
            }  
            include __DIR__. '/includes/formulario.php';
            break;
    };
    include __DIR__. '/includes/footer.php';
    
?>