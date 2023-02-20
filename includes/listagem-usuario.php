    <?php

        $mensagem = '';
        if (isset($_GET['status'])) {
            $mensagem = match ($_GET['status']) {
              "success" => '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Ação executada com sucesso!</strong>
                        <a href="index.php?page=usuario"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
                    </div>
                    ',
              "error" => '
                    <div class="alert text-bg-danger alert-dismissible fade show" role="alert">
                        <strong>Ação não executada!</strong>
                        <a href="index.php?page=usuario"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
                    </div>
                    ',
            };
        }

        $resultados = '';
            foreach($usuarios as $usuario){
                $resultados .= '<tr>
                                    <td>'.$usuario->nome.'</td>
                                    <td>'.$usuario->nivelacesso.'</td>
                                    <td>
                                        <a href="editar.php?page=usuario&id='.$usuario->id.'" class="m-1"><button type="button" class="btn btn-primary">Editar</button></a><a href="excluir.php?page=usuario&id='.$usuario->id.'"><button type="button" class="btn btn-danger">Excluir</button></a>
                                    </td>
                                </tr>';
            }
    ?>
<div class="container my-3">
    <main>

        <section>
            <?= $mensagem ?>
        </section>
        
        <section>
            <a href="cadastrar.php?page=usuario">
                <button class="btn btn-success">Novo Cadastro</button>
            </a>
        </section>

        <section>
            <table class="table bg-light mt-3">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nivel de Acesso</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?=$resultados?>
                </tbody>
            </table>
        </section>

    </main>