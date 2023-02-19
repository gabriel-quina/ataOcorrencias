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
                    $one = $condominio->one_integracao == '' ?
                        '' : 
                        '<a href="index.php?page=condominio&id='.$condominio->id.'#condominioId'.$condominio->id.'"
                        class="btn btn-outline-secondary m-1">
                        <small>
                        <i class="bi bi-arrow-right-square-fill"> ONE PORTARIA</i>
                        </small>
                        </a>
                    ' ;
                    
                    if (isset($_GET['id']) && $condominio->id == $_GET['id']) {
                        $modalContent .= '
                        <div class="w-100">
                            <iframe class="vh-100 col-12" src="'.$condominio->one_integracao.'"></iframe>
                        </div>                        
                        ';
                    };

                    include __DIR__. '/../includes/resultados-condominio.php';
            
                    }
                    
                    ?>
                    <?=$resultados?>                        
                </tbody>
            </table>
        </section>
    </main>
    <div class="modal fade" id="modalCondominio" tabindex="-1" aria-labelledby="modalCondominio" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content vh-100">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-dark" id="ToggleLabel">Plano B</h1>
                    <a href="index.php?page=condominio#condominioId<?=$_GET['id']?>" class="btn btn-close"></a>
                </div>
                <div class="modal-body">                    
                    <?=  $modalContent ?>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum quaerat unde cumque nulla exercitationem quas totam nihil incidunt quae doloribus aliquam ut deleniti itaque tempora soluta atque ullam, quisquam cum in maiores reprehenderit. Magni quasi, unde corrupti blanditiis ratione nam vitae? Ad voluptas molestiae, magni porro neque omnis repellat beatae, illo maiores reprehenderit accusamus. Accusantium eaque exercitationem dolorem possimus fuga maxime nemo officia at! Repudiandae placeat quis fugiat expedita harum cupiditate, aperiam doloremque laboriosam qui labore quo reiciendis laborum ducimus voluptates maxime! Culpa, nesciunt libero? Asperiores deserunt, soluta dolore dicta nemo sapiente cum fuga nihil voluptates amet tenetur fugit vitae?</p>   
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    </div>
