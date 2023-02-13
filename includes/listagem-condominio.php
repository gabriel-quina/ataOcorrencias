    <?php
        $mensagem = '';
        if (isset($_GET['status'])) {
            switch ($_GET['status']) {
                case "success":
                    $mensagem = '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Ação executada com sucesso!</strong>
                        <a href="index.php?page=condominio"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
                    </div>
                    ';
                    break;
        
                case "error":
                    $mensagem = '
                    <div class="alert text-bg-danger alert-dismissible fade show" role="alert">
                        <strong>Ação não executada!</strong>
                        <a href="index.php?page=condominio"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
                    </div>
                    ';
                    break;
            }
        }
        $resultados = '';
            foreach($condominios as $condominio){
                $one = $condominio->one_integracao == '' ? '' : '<button class="link-dark" data-bs-toggle="modal" data-bs-target="#exampleModal'.$condominio->id.'">
                    <small>
                        <i class="bi bi-arrow-right-square-fill"></i><span class="p-1 badge text-dark">ONE PORTARIA</span>
                    </small>
                </button>' ;
                $resultados .= '<tr>
                                    <td><h6>'.$condominio->nome_condominio.'</h6></td>
                                    <td>'.$one.'</td>
                                    <td>'.$condominio->cod_moni.'</td>
                                    <td class="text-center">
                                        <a href="editar.php?page=condominio&id='.$condominio->id.'" class="m-1"><button type="button" class="btn btn-primary">Editar</button></a><a href="excluir.php?page=condominio&id='.$condominio->id.'"class="m-1"><button type="button" class="btn btn-danger">Excluir</button></a>
                                    </td>
                                </tr>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal'.$condominio->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen-md-down modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <iframe class="embed-responsive-item" width="100%" height="500" src="'.$condominio->one_integracao.'" allowfullscreen></iframe>
                                            </div>                    
                                        </div>
                                    </div>
                                </div>';
            };

            $resultados = strlen($resultados) ? $resultados : '<tr class="mt-2 py-2 text-bg-info fw-bold"">
            <td colspan="3" class="text-center">
               Nenhum condominio encontrado
            </td>
            </tr>';
    ?>
    <div class="container my-3">
        <main>
            <section>
                <?= $mensagem ?>
            </section>

            <section>
                <a href="cadastrar.php?page=condominio">
                    <button class="btn btn-success">Novo Cadastro</button>
                </a>
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
                        <?=$resultados?>                        
                    </tbody>
                </table>
            </section>
        </main>
