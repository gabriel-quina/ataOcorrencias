    <?php
        $resultados = '';
            foreach($ocorrencias as $ocorrencia){
                $resultados .= '<tr>
                                    <td>'.$ocorrencia->id.'</td>
                                    <td>'.$ocorrencia->condominio.'</td>
                                    <td>'.$ocorrencia->ocorrencia.'</td>
                                    <td>'.date('d/m/Y',strtotime($ocorrencia->data_inicio)).'</td>
                                    <td>'.date('d/m/Y',strtotime($ocorrencia->data_fim)).'</td>
                                    <td>
                                        <a href="editar.php?page=condominio&id='.$ocorrencia->id.'"><button type="button" class="btn btn-primary">Editar</button></a><a href="excluir.php?page=condominio&id='.$ocorrencia->id.'"><button type="button" class="btn btn-danger">Excluir</button></a>
                                    </td>
                                </tr>';
            }
    ?>
<div class="container">
    <main>
        <section>
            <a href="cadastrar.php">
                <button class="btn btn-success">Novo Cadastro</button>
            </a>
        </section>

        <section>
            <table class="table bg-light mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CONDOMINIO</th>
                        <th>OCORRENCIA</th>
                        <th>DATA INICIO</th>
                        <th>DATA FIM</th>
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