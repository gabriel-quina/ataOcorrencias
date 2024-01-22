<?php
$listacondominios = '<select class="form-select" name="condominio"><option value="">Selecione um condomínio</option>';
foreach($condominios as $condominio) {
    $active = $obOcorrencia->condominio == $condominio->nome_condominio ? ' selected' : '';
    $listacondominios .= '<option'.$active.' value="'.$condominio->id.'|'.$condominio->nome_condominio.'">'.$condominio->nome_condominio.'</option>';
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
    <form method="post">
      <div class="row">
        <div class="form-group col-4">
          <label for="">Condominio</label>
            <?= $_SERVER['PHP_SELF'] == '/editar.php' ?
            '<input type="text" class="form-control pe-none" value="'.$obOcorrencia->condominio.'">
             <input type="hidden" name="condominio" value="'.$obOcorrencia->id_condominio.'|'.$obOcorrencia->condominio.'">' :
              $listacondominios
            ?>
        </div>
        <div class="form-group col-4">
          <label for="tipoOcorrencia">Tipo de ocorrencia</label>
          <select class="form-select" name="tipo_ocorrencia">
            <?= $_SERVER['PHP_SELF'] == '/editar.php' ?
            '<option>'.$obOcorrencia->tipo_ocorrencia.'</option>' : ''
            ?>
            <option>Técnica</option>
            <option>Informativa</option>
          </select>
        </div>
        <div class="form-group col-4">
          <label for="statusOcorrencia">Status</label>
          <select class="form-select" name="statusOcorrencia">
              <option>Pendente</option>
              <option>Resolvido</option>
          </select>
        </div>
      </div>
      <div class="form-group">
          <label for="">Ocorrencia</label><pre><textarea class="form-control" rows="10" name="ocorrencia"><?= $obOcorrencia->ocorrencia ?></textarea></pre>
      </div>
      <div class="form-group mt-3">
          <button type="submit" class="btn btn-success">Enviar</button>
      </div>
    </form>
  </main>