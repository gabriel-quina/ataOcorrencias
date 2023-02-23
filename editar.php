<?php

    //#composer require __DIR__. '/vendor/autoload.php'
    require __DIR__. '/app/Entity/Ocorrencia.php';
    require __DIR__. '/app/Entity/Condominio.php';
    require __DIR__. '/app/Entity/Usuario.php';
    require __DIR__. '/app/Db/Database.php';
    require __DIR__. '/app/Session/Login.php';

    define('TITLE','Editar');

    use \App\Entity\Ocorrencia;
    use \App\Entity\Condominio;
    use \App\Entity\Usuario;
    use \App\Session\Login;

    Login::requireLogin();

    $alertaCadastro = '';

    date_default_timezone_set('America/Sao_Paulo');

    $condominios = Condominio::getCondominios(null,null,'nome_condominio',null);

    $obCondominio = Condominio::getCondominio($_GET['id']);
    $obOcorrencia = Ocorrencia::getOcorrencia($_GET['id']);
    $obUsuario = Usuario::getUsuarioPorId($_GET['id']);

    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
        header('location: index.php?page='.$_GET['page'].'&status=error');
        exit;
    }
    
    include __DIR__. '/includes/header.php';
    switch ($_GET['page']) {
        case "condominio":
                        
            if(!$obCondominio instanceof Condominio){
                header('location: index.php?page='.$_GET['page'].'&status=error');
                exit;
            }
            if(isset($_POST['nome_condominio'],$_POST['cod_moni'],$_POST['one_integracao'])){

                $obCondominio->nome_condominio = $_POST['nome_condominio'];
                $obCondominio->cod_moni = $_POST['cod_moni'];
                $obCondominio->one_integracao = $_POST['one_integracao'];
                $obCondominio->atualizar();
                
                header('location: index.php?page='.$_GET['page'].'&status=success');
                exit;
                
            }
            include __DIR__. '/includes/formulario-condominio.php';
            break;
        case "usuario":

            if(!$obUsuario instanceof Usuario){
                header('location: index.php?page='.$_GET['page'].'&status=error');
                exit;
            }
            if(isset($_POST['nome'],$_POST['nivelacesso'])){
                
                $obUsuario->nome = $_POST['nome'];
                if (strlen($_POST['senha'])){
                    $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                }
                $obUsuario->nivelacesso = $_POST['nivelacesso'];
                $obUsuario->atualizar();
                header('location: index.php?page='.$_GET['page'].'&status=success'); 
                exit;
            }
            
            include __DIR__. '/includes/formulario-cadastro.php';
            break;
        case "ata": 
            
            if(!$obOcorrencia instanceof Ocorrencia){
                header('location: index.php?page='.$_GET['page'].'&status=error');
                exit;
            }
            if(isset($_POST['ocorrencia'],$_POST['data_inicio'],$_POST['data_fim'],$_POST['statusOcorrencia'])){
                                
                $obOcorrencia->ocorrencia = $_POST['ocorrencia'];
                $obOcorrencia->data_inicio = $_POST['data_inicio'];
                $obOcorrencia->data_fim = $_POST['data_fim'];
                $obOcorrencia->status= $_POST['statusOcorrencia'];
                $obOcorrencia->atualizar();

                header('Location: index.php?page='.$_GET['page'].'&status=success');
                exit;
            }
            include __DIR__. '/includes/formulario.php';
            break;
    };
    include __DIR__. '/includes/footer.php';
    
?>