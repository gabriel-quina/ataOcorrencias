<?php

use App\Entity\Ocorrencia;

date_default_timezone_set('America/Sao_Paulo');

$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case "success":
            $mensagem = '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Ação executada com sucesso!</strong>
                <a href="index.php?page=ata"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
            </div>
            ';
            break;

        case "error":
            $mensagem = '
            <div class="alert text-bg-danger alert-dismissible fade show" role="alert">
                <strong>Ação não executada!</strong>
                <a href="index.php?page=ata"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
            </div>
            ';
            break;

        case "erroracesso":
            $mensagem = '
            <div class="alert text-bg-warning alert-dismissible fade show" role="alert">
                <strong>Acesso não autorizado!</strong>
                <a href="index.php?page=ata"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
            </div>
            ';
            break;
    }
}

$resultados = !empty($ocorrencias)
? '' 
: '<div class="row mt-2 py-2 text-bg-info fw-bold"">
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
                        <button type="submit" class="btn btn-primary btn-sm lh-1">Aplicar Filtro</button>
                    </div>
                    <div class="col-2 col-lg-1 d-flex align-items-end justify-content-center">
                        <a href="index.php?page=ata">    
                            <div class="btn btn-light btn-sm lh-1">Limpar Filtro</div>
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
                        <input type="date" class="form-control" name="data_busca"
                        value="<?= isset($_GET['data_busca']) ? $_GET['data_busca'] : date('Y-m-d') ?>">
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
                <?php
                
                foreach ($ocorrencias as $ocorrencia) {

                    $leitores = '';                    
                    $lida = false;

                    $lidasConsulta = Ocorrencia::getOcorrenciasLidas('usuarios t2 ON t2.id = id_usuario',
                    'id_ocorrencias = ' .$ocorrencia->id,
                    null,
                    null,
                    'id_ocorrencias, id_usuario, nome, datetime'
                    );

                    foreach ($lidasConsulta as $lidaConsulta) {
                        $leitores .= ' <span class="badge bg-secondary">'.$lidaConsulta->nome.'</span> ';
                        if ($lidaConsulta->id_usuario == $_SESSION['usuario']['id']){
                            $lida = true;
                        }
                    }

                    $status = $ocorrencia->status == 'Resolvido' ? ' text-bg-success' : ' text-bg-danger';
                                                            
                    include __DIR__. '/../includes/resultados-ata.php';

                }

                ?>
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