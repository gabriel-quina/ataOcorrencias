<?php

    //#composer require __DIR__. '/vendor/autoload.php'
    require __DIR__. '/app/Entity/Ocorrencia.php';
    require __DIR__. '/app/Entity/Condominio.php';
    require __DIR__. '/app/Entity/Usuario.php';
    require __DIR__. '/app/Db/Database.php';
    require __DIR__. '/app/Db/Pagination.php';
    require __DIR__. '/app/Session/Login.php';

    use \App\Entity\Ocorrencia;
    use \App\Entity\Condominio;
    use \App\Entity\Usuario;
    use \App\Db\Pagination;
    use \App\Session\Login;

    Login::requireLogin();

    date_default_timezone_set('America/Sao_Paulo');

    $condominios = Condominio::getCondominios(null,null,'nome_condominio',null);
    
    // BUSCA
    $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);
        
    // FILTRO CONDOMINIOS
    $filtroCondominios = filter_input(INPUT_GET,'condominios',FILTER_SANITIZE_NUMBER_INT);
    $filtroCondominios = $filtroCondominios == 'Todos' ? null : $filtroCondominios;

    // FILTRO DATA
    $filtroData = filter_input(INPUT_GET,'data_busca',FILTER_SANITIZE_STRING);

    // FILTRO SITUAÇÃO
    $filtroSituacao = match (filter_input(INPUT_GET,'situacao',FILTER_SANITIZE_STRING)) {
        "Pendente" => 'status = "Pendente"',
        "Resolvido" => 'status = "Resolvido"',
        "Todos" => 'status != "Todos"',
        default => 'status = "Pendente"'
    };

    //CONDIÇÕES SQL
    $condicoes = [
        strlen($busca) ? 'ocorrencia LIKE "%'.str_replace(" ","%",$busca).'%"' : null,
        strlen($filtroCondominios) ? 'id_condominio = "'.$filtroCondominios.'"' : null,
        $filtroSituacao,
        strlen($filtroData) ? 'data_inicio <="'.$filtroData.'" AND data_fim >="'.$filtroData.'"' : null,
    ];

    //REMOVE POSIÇÕES VAZIAS
    $condicoes = array_filter($condicoes);
    
    //CLAUSULA WHERE
    $where = implode(' AND ',$condicoes);

    $quantidadeOcorrencias = Ocorrencia::getQtdOcorrencias($where);

    // PAGINAÇÃO
    $obPagination = new Pagination($quantidadeOcorrencias, $_GET['p'] ?? 1, 10);

    $ocorrencias = Ocorrencia::getOcorrencias(
        'INNER JOIN condominios AS t2 ON t1.id_condominio = t2.id',
        $where,
        null,
        $obPagination->getLimit(),
        't1.id, t1.ocorrencia, t1.data_inicio, t1.data_fim, t1.status, t1.id_condominio, t2.nome_condominio, t2.one_integracao, t2.cod_moni'
    );

    $usuarios = Usuario::getUsuarios(null,null,'nome',null); 

    $gets = http_build_query($_GET);
    
    if (!isset($_GET['page'])){
        header('location: index.php?page=ata&'.$gets.'');
    }

    include __DIR__. '/includes/header.php';
    
    switch ($_GET['page']) {
        case "condominio":
            include __DIR__. '/includes/listagem-condominio.php';
            break;
        case "usuario":
            Login::requireAcesso(1);

            include __DIR__. '/includes/listagem-usuario.php';
            break;
        case "ata":
            include __DIR__. '/includes/listagem-ata.php';
            break;
    };
    
    include __DIR__. '/includes/footer.php';
