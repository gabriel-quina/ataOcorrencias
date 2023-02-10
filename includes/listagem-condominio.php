    <?php
        $resultados = '';
            foreach($condominios as $condominio){
                $resultados .= '<tr>
                                    <td>'.$condominio->nome_condominio.'</td>
                                    <td>'.$condominio->cod_moni.'</td>
                                    <td class="text-center">
                                        <a href="editar.php?page=condominio&id='.$condominio->id.'" class="m-1"><button type="button" class="btn btn-primary">Editar</button></a><a href="excluir.php?page=condominio&id='.$condominio->id.'"class="m-1"><button type="button" class="btn btn-danger">Excluir</button></a>
                                    </td>
                                </tr>';
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
            <a href="cadastrar.php?page=condominio">
                <button class="btn btn-success">Novo Cadastro</button>
            </a>
        </section>

        <section>
            <table class="table bg-light mt-3">
                <thead>
                <tr>
                    <th>Nome</th>
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