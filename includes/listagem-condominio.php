<?php
    $mensagem = '';
    if (isset($_GET['status'])) {
        $mensagem = match ($_GET['status']) {
          "success" => '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Ação executada com sucesso!</strong>
                    <a href="index.php?page=condominio"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
                </div>
                ',
          "error" => '
                <div class="alert text-bg-danger alert-dismissible fade show" role="alert">
                    <strong>Ação não executada!</strong>
                    <a href="index.php?page=condominio"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
                </div>
                ',
        };
    }
    
    $modalContent = '';    

    $resultados = '';
    $resultados = !empty($condominios)
    ? '' 
    : '<div class="row mt-2 py-2 text-bg-info fw-bold"">
        <div class="col-12 d-flex justify-content-center">
            Nenhum condominio encontrado
        </div>
    </div>';
?>
<div class="container my-3">
    <main>
        <section>
            <?= $mensagem ?>
        </section>

        <section>
            <a href="cadastrar.php?page=condominio" class="btn btn-success">Novo Cadastro</a>
        </section>

        <section>
            <table class="table bg-light mt-3">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th></th>
                    <th>Cod. Moni</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php

                    foreach($condominios as $condominio){
                    $one = $condominio->one_integracao == ''
                            ? ''
                            : '<a href="index.php?page=condominio&id='.$condominio->id.'#condominioId'.$condominio->id.'"
                                  class="btn btn-outline-secondary m-1">
                                <small>
                                <i class="bi bi-arrow-right-square-fill"> ONE PORTARIA</i>
                                </small>
                            </a>
                    ' ;
                    
                    if (isset($_GET['id']) && $condominio->id == $_GET['id']) {
                        $modalContent .= '
                        <div class="h-100">
                            <iframe id="iframe" class="w-100 h-100" style="display:block" src="'.$condominio->one_integracao.'"></iframe>
                        </div>                        
                        ';
                    };

                    include __DIR__. '/../includes/resultados-condominio.php';
            
                    }
                    
                    ?>
                    <?= $resultados ?>
                </tbody>
            </table>
        </section>
    </main>    
</div>
