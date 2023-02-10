<?php
date_default_timezone_set('America/Sao_Paulo');

$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case "success":
            $mensagem = '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Ação executada com sucesso!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
            break;

        case "error":
            $mensagem = '
            <div class="alert text-bg-danger alert-dismissible fade show" role="alert">
                <strong>Ação não executada!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
            break;
    }
}

$resultados = '';
foreach ($ocorrencias as $ocorrencia) {
    $status = $ocorrencia->status == 'Resolvido' ? ' text-bg-success' : ' text-bg-danger';
    $resultados .= '<div class="row mt-2 bg-primary-subtle border-primary-subtle rounded-start rounded-end"><div class="col-4 col-lg-6 d-flex align-items-center text-dark fw-bold text-uppercase">' . $ocorrencia->condominio . '</div><div class="col-3 col-lg-2 d-flex align-items-center justify-content-center"><span class="badge rounded-pill text-bg-secondary">Data inicio: ' . date('d/m', strtotime($ocorrencia->data_inicio)) . '</span></div><div class="col-3 col-lg-2 d-flex align-items-center justify-content-center"><span class="badge rounded-pill text-bg-secondary">Data final: ' . date('d/m', strtotime($ocorrencia->data_fim)) . '</span></div><div class="col-2 col-lg-2 d-flex align-items-center justify-content-center' . $status . ' rounded-end"><span class="badge">Situação<br>' . $ocorrencia->status . '</span></div></div><div class="row text-bg-light pb-2 rounded-start rounded-end"><div style="white-space: pre-wrap;" class="col-10 word-wrap text-break p-2"<p class="lh-sm fw-light">' . $ocorrencia->ocorrencia . '</p></div><div class="col-2 border-start border-2 my-2 d-flex align-content-center justify-content-evenly flex-wrap"><a href="editar.php?page=ata&id='. $ocorrencia->id .'"><button type="button" class="badge btn btn-primary my-2">Editar</button></a><a href="excluir.php?page=ata&id='.$ocorrencia->id.'"><button type="button" class="badge btn btn-danger my-2">Excluir</button></a></div><div class="col"><div class="row border-top border-2 mx-2"><!--<div class="col-2 col-lg-1 d-flex"><a class="link-dark" data-bs-toggle="collapse" href="#multiCollapseExample'. $ocorrencia->id .'" role="button" aria-expanded="false" aria-controls="multiCollapseExample'. $ocorrencia->id .'"><small><span class="badge bg-info p-1 rounded">Lido por:</span></small></a></div><div class="col-4 col-lg-2 d-flex justify-content-center flex-wrap"><div class="collapse multi-collapse" id="multiCollapseExample'. $ocorrencia->id .'"><div class="float-right"><span class="badge bg-secondary">Luiz</span> <span class="badge bg-secondary">Victor</span> <span class="badge bg-secondary">Matheus</span> <span class="badge bg-secondary">Mara</span> <span class="badge bg-secondary">Gustavo</span> <span class="badge bg-secondary">Alexandre</span></div></div></div>--></div></div></div>';
}

$resultados = strlen($resultados) ? $resultados : '<div class="row mt-2 py-2 text-bg-info fw-bold"">
                                                         <div class="col-12 d-flex justify-content-center">
                                                            Nenhuma ocorrencia encontrada
                                                         </div>
                                                       </div>';

$listacondominios = '';
foreach ($condominios as $condominio) {
    $active = '';
    if (isset($_GET['condominios'])) {
        $active = $_GET['condominios'] == $condominio->nome_condominio ? 'selected' : '';
    }
    $listacondominios .= '<option ' . $active . '>' . $condominio->nome_condominio . '</option>';
}

unset($_GET['status']);
unset($_GET['p']);
$gets = http_build_query($_GET);

$paginacao = '';
$paginas = $obPagination->getPages();
foreach ($paginas as $key => $pagina) {
    $class = $pagina['atual'] ? 'active disabled" aria-current="page"' : '"';
    $paginacao .= '<li class="page-item ' . $class . '>
                <a class="page-link" href="?p=' . $pagina['p'] . '&' . $gets . '">' . $pagina['p'] . '</a>
                </li>';
}

if (isset($_GET['situacao'])) {
    $situacao = $_GET['situacao'];
}

?>

<div class="container mt-3">

    <main>

        <section>
            <?= $mensagem ?>
        </section>

        <section>
            <a href="cadastrar.php?page=ata">
                <button class="btn btn-success mb-3">Novo Cadastro</button>
            </a>
        </section>

        <section>

            <form method="get">

                <div class="row">
                    <div class="form-group col-4 col-lg-6">
                        <label for="">Filtrar Condominio</label>
                        <select class="form-select" name="condominios">
                            <option>Todos</option>
                            <?= $listacondominios ?>
                        </select>
                    </div>
                    <div class="form-group col-4 col-lg-4">
                        <label>Situação</label>
                        <select class="form-select" name="situacao">
                            <option <?= $filtroSituacao == 'status = "Pendente"' ? 'selected' : '' ?>>Pendente</option>                           
                            <option <?= $filtroSituacao == 'status = "Resolvido"' ? 'selected' : '' ?>>Resolvido</option>
                            <option <?= $filtroSituacao == 'status != "Todos"' ? 'selected' : '' ?>>Todos</option>
                        </select>
                    </div>                    
                    <div class="col-2 col-lg-1 d-flex align-items-end justify-content-center">
                        <button type="submit" class="btn btn-primary lh-1">Aplicar Filtro</button>
                    </div>
                    <div class="col-2 col-lg-1 d-flex align-items-end justify-content-center">
                        <a href="index.php?page=ata">    
                            <div class="btn btn-light lh-1">Limpar Filtro</div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-8 col-lg-10">
                        <label for="">Buscar Ocorrencia</label>
                        <input type="text" name="busca" class="form-control" value="<?= $busca ?>">
                    </div>
                    <div class="form-group col-4 col-lg-2">
                        <label for="data_inicio">Data</label>
                        <input type="date" class="form-control" name="data_busca" value="<?= isset($_GET['data_busca']) ? $_GET['data_busca'] : date('Y-m-d') ?>">
                    </div>
                </div>

            </form>

        </section>

        <section>

            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-center mt-3">
                    <?= $paginacao ?>
                </ul>
            </nav>

        </section>

        <section>

            <div class="container my-3">
                <?= $resultados ?>
            </div>

        </section>

        <section>

            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-center">
                    <?= $paginacao ?>
                </ul>
            </nav>

        </section>

    </main>