<?php

//#composer require __DIR__. '/vendor/autoload.php'
require __DIR__. '/app/Controller/Pages/Page.php';
require __DIR__. '/app/Entity/Ocorrencia.php';
require __DIR__. '/app/Entity/Autorizacoes.php';
require __DIR__. '/app/Entity/Condominio.php';
require __DIR__. '/app/Entity/Usuario.php';
require __DIR__. '/app/Utils/View.php';
require __DIR__. '/app/Db/Database.php';
require __DIR__. '/app/Db/Pagination.php';
require __DIR__. '/app/Session/Login.php';

use App\Controller\Pages\Page;
use App\Entity\Ocorrencia;
use App\Entity\Autorizacoes;
use App\Entity\Condominio;
use App\Entity\Usuario;
use App\Utils\View;
use App\Db\Pagination;
use App\Session\Login;

Login::requireLogin();

date_default_timezone_set('America/Sao_Paulo');

$condominios = Condominio::getCondominios(null, 'tipoatendimento != "Descontinuado"', 'nome_condominio', null);

// BUSCA
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

// FILTRO CONDOMINIOS
$filtroCondominios = filter_input(INPUT_GET, 'condominios', FILTER_SANITIZE_STRING);
$filtroCondominios = $filtroCondominios == 'Todos' ? null : $filtroCondominios;

// FILTRO DATA
$filtroData = filter_input(INPUT_GET, 'data_busca', FILTER_SANITIZE_STRING);

// FILTRO SITUAÇÃO
$filtroSituacao = filter_input(INPUT_GET, 'situacao', FILTER_SANITIZE_STRING);
switch ($filtroSituacao) {
    case "Pendente":
        $filtroSituacao = 'status = "Pendente"';
        break;
    case "Resolvido":
        $filtroSituacao = 'status = "Resolvido"';
        break;
    case "Todos":
        $filtroSituacao = 'status != "Todos"';
        break;
    default:
        $filtroSituacao = 'status = "Pendente"';
}

// FILTRO SITUAÇÃO
$filtroTipoOcorrencia = filter_input(INPUT_GET, 'tipo_ocorrencia', FILTER_SANITIZE_STRING);
switch ($filtroTipoOcorrencia) {
    case "Técnica":
        $filtroTipoOcorrencia = 'tipo_ocorrencia = "Técnica"';
        break;
    case "Informativa":
        $filtroTipoOcorrencia = 'tipo_ocorrencia = "Informativa"';
        break;
    case "Todos":
        $filtroTipoOcorrencia = 'tipo_ocorrencia != "Todos"';
        break;
    default:
        $filtroTipoOcorrencia = 'tipo_ocorrencia != "Todos"';
}

// FILTRO SITUAÇÃO
$filtroTipoAtendimento = filter_input(INPUT_GET, 'tipo_atendimento', FILTER_SANITIZE_STRING);
switch ($filtroTipoAtendimento) {
    case "Assistida":
        $filtroTipoAtendimento = 'tipoatendimento= "Portaria Assistida"';
        break;
    case "Hibrida":
        $filtroTipoAtendimento = 'tipoatendimento = "Portaria Hibrida"';
        break;
    case "24 Horas":
        $filtroTipoAtendimento = 'tipoatendimento = "Portaria 24 Horas"';
        break;
    case "Todos":
        $filtroTipoAtendimento = 'tipoatendimento != "Todos"';
        break;
    default:
        $filtroTipoAtendimento = 'tipoatendimento != "Todos"';
}

$usuarios = Usuario::getUsuarios(null, null, 'nome', null);

$gets = http_build_query($_GET);

if (!isset($_GET['page'])) {
    header('location: index.php?page=ata&'.$gets.'');
}

include __DIR__. '/includes/header.php';

switch ($_GET['page']) {
    case "ata":      
      //CONDIÇÕES SQL
      $condicoes = [
        strlen($busca) ? 'ocorrencia LIKE "%'.str_replace(" ", "%", $busca).'%"' : null,
        strlen($filtroCondominios) ? 'condominio = "'.$filtroCondominios.'"' : null,
        $filtroSituacao,
        $filtroTipoOcorrencia,
        strlen($filtroData) ? 'criado_em LIKE "%'.$filtroData.'%"' : null,
      ];

      $joins = [
        'INNER JOIN condominios t2 ON t2.id = t1.id_condominio',
        'INNER JOIN usuarios t3 ON t3.id = t1.criado_por',
        'INNER JOIN usuarios t4 ON t4.id = t1.modificado_por'
      ];

      //REMOVE POSIÇÕES VAZIAS
      $condicoes = array_filter($condicoes);
      $joins = array_filter($joins);

      //CLAUSULA WHERE
      $where = implode(' AND ', $condicoes);

      $quantidadeOcorrencias = Ocorrencia::getQtdOcorrencias($where);

      // PAGINAÇÃO
      $obPagination = new Pagination($quantidadeOcorrencias, $_GET['p'] ?? 1, 10);

      $ocorrencias = Ocorrencia::getOcorrencias( implode(' ', $joins),
                                                 $where, 't1.id DESC', $obPagination->getLimit(),
                                                 't1.*, t2.nome_condominio, t3.nome AS criado_por_nome, t4.nome AS modificado_por_nome');

      include __DIR__. '/includes/listagem-ata.php';
      break;

    case "autorizacoes":
      
      //CONDIÇÕES SQL
      $condicoes = [
        strlen($busca) ? 'autorizacao LIKE "%'.str_replace(" ", "%", $busca).'%"' : null,
        strlen($filtroCondominios) ? 'condominio = "'.$filtroCondominios.'"' : null,
        strlen($filtroData) ? 'data_inicio <="'.$filtroData.'" AND data_fim >="'.$filtroData.'"' : 'data_inicio <="'.date('Y-m-d').'" AND data_fim >="'.date('Y-m-d').'"',
      ];

      //REMOVE POSIÇÕES VAZIAS
      $condicoes = array_filter($condicoes);

      //CLAUSULA WHERE
      $where = implode(' AND ', $condicoes);

      $quantidadeAutorizacoes = Autorizacoes::getQtdAutorizacoes($where);

      // PAGINAÇÃO
      $obPagination = new Pagination($quantidadeAutorizacoes, $_GET['p'] ?? 1, 5);

      $autorizacoes = Autorizacoes::getAutorizacoes(null, $where, '`id` DESC', $obPagination->getLimit());

      include __DIR__. '/includes/listagem-autorizacoes.php';
      break;

    case "condominio":
      $condicoes = [
        strlen($filtroCondominios) ? 'nome_condominio = "'.$filtroCondominios.'"' : null,
        'tipoatendimento != "Descontinuado"',
        $filtroTipoAtendimento
      ];

      //REMOVE POSIÇÕES VAZIAS
      $condicoes = array_filter($condicoes);

      //CLAUSULA WHERE
      $where = implode(' AND ', $condicoes);

      $condominios = Condominio::getCondominios(null, $where, 'nome_condominio', null);

      include __DIR__. '/includes/listagem-condominio.php';
      break;

    case "devcondominio":
      include __DIR__. '/includes/dev-listagem-condominio.php';
      break;

    case "usuario":
      Login::requireAcesso(1);
      include __DIR__. '/includes/listagem-usuario.php';
      break;    
};

include __DIR__. '/includes/footer.php';
