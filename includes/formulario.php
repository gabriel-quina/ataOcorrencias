<?php
        $listacondominios = '<select class="form-select" name="id_condominio">';
        foreach($condominios as $condominio){
                $active = $obOcorrencia->id_condominio == $condominio->id ? ' selected' : '';
                $listacondominios .= '<option value="'.$condominio->id.'"'.$active.'>'.$condominio->nome_condominio.'</option>';
            }
        $listacondominios = $listacondominios.'</select>';

?>

<div class="container my-3">
    <main>
        <section>
            <a href="index.php?page=ata">
                <button class="btn btn-success">Voltar</button>
            </a>
        </section>
        <h2 class="mt-3"><?=TITLE?></h2>

        <form method="post">
            <div class="row">
            <div class="form-group col-8">
                <label for="">Condominio</label>
                    <?= $_SERVER['PHP_SELF'] == '/dev/editar.php' ? '<input type="text" class="form-control pe-none" name="id_condominio" value="'.$obOcorrencia->nome_condominio.'">' : $listacondominios ?></div>
            <div class="form-group col-4">
                <label for="">Status</label>
                <select class="form-select" name="statusOcorrencia">
                    <option>Pendente</option>
                    <option>Resolvido</option>
                </select>
            </div>
            </div>
            <div class="form-group">
                <label for="">Ocorrencia</label><pre><textarea class="form-control" rows="6" name="ocorrencia"><?= $obOcorrencia->ocorrencia ?></textarea></pre>
            </div>
            <div class="row">
            <div class="form-group col-6">
                <label for="data_inicio">Data Inicio</label>
                <input type="date" class="form-control" name="data_inicio"
                        <?= $_SERVER['PHP_SELF'] == '/dev/editar.php'
                        ? ' value="'.$obOcorrencia->data_inicio.'" min="'.$obOcorrencia->data_inicio.'"' 
                        : ' value="'.date('Y-m-d').'" min="'.date('Y-m-d').'"' ?>>
            </div>
            <div class="form-group col-6">
                <label for="data_fim">Data Final</label>
                <input type="date" class="form-control" name="data_fim"
                        <?= $_SERVER['PHP_SELF'] == '/dev/editar.php'
                        ? ' value="'.$obOcorrencia->data_fim.'" min="'.$obOcorrencia->data_inicio.'"' 
                        : ' value="'.date('Y-m-d').'" min="'.date('Y-m-d').'"' ?>>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
        </form>
    </main>