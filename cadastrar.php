<?php

    //#composer require __DIR__. '/vendor/autoload.php'
    require __DIR__. '/app/Entity/Ocorrencia.php';
    require __DIR__. '/app/Entity/Condominio.php';
    require __DIR__. '/app/Entity/Usuario.php';
    require __DIR__. '/app/Db/Database.php';
    require __DIR__. '/app/Session/Login.php';

    define('TITLE','Cadastrar');

    use \App\Entity\Ocorrencia;                                     
    use \App\Entity\Condominio;
    use \App\Entity\Usuario;
    use \App\Session\Login;

    Login::requireLogin();

    $alertaCadastro = '';

    date_default_timezone_set('America/Sao_Paulo');

    $condominios = Condominio::getCondominios(null, null,'nome_condominio',null);

    include __DIR__. '/includes/header.php';
    switch ($_GET['page']) {
        case "condominio":
            $obCondominio = new Condominio;
            if(isset($_POST['nome_condominio'],$_POST['cod_moni'],$_POST['one_integracao'])){
                $obCondominio->nome_condominio = $_POST['nome_condominio'];
                $obCondominio->cod_moni = $_POST['cod_moni'];
                $obCondominio->one_integracao = $_POST['one_integracao'];
                $obCondominio->cadastrar();
                
                header('location: index.php?page=condominio&status=success');
                exit;                
            }
            include __DIR__. '/includes/formulario-condominio.php';
            break;
        case "usuario":
            $obUsuario = new Usuario;
            if(isset($_POST['nome'],$_POST['senha'],$_POST['nivelacesso'])){
                    
                $usuarioLogado = Usuario::getUsuarioPorNome($_POST['nome']);
                if($usuarioLogado instanceof Usuario){
                    $alertaCadastro = 'O usuario digitado já está em uso';
                }else{

                $obUsuario->nome = $_POST['nome'];
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $obUsuario->nivelacesso = $_POST['nivelacesso'];
                $obUsuario->cadastrar();
                
                header('location: index.php?page=usuario&status=success');
                exit;
                }          
            }        
            include __DIR__. '/includes/formulario-cadastro.php';
            break;
        case "ata":
            $obOcorrencia = new Ocorrencia;
            if(isset($_POST['id_condominio'],$_POST['ocorrencia'],$_POST['data_inicio'],$_POST['data_fim'],$_POST['statusOcorrencia'])){
                $obOcorrencia->id_condominio = $_POST['id_condominio'];
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