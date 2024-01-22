<?php
$listacondominios = '<select class="form-select" name="condominio"><option value="">Selecione um condomínio</option>';
foreach($condominios as $condominio) {
    $active = $obAutorizacao->condominio == $condominio->nome_condominio ? ' selected' : '';
    $listacondominios .= '<option'.$active.' value="'.$condominio->id.'|'.$condominio->nome_condominio.'">'.$condominio->nome_condominio.'</option>';
}
$listacondominios = $listacondominios.'</select>';

$placeholder = <<<EOD
  Liberação de entrada

  Entrada liberada por      : 
  Liberação para o APT Nº   : 
  Visitante, Ps, etc        : 
  Pessoas liberadas + CPF   : 
  Liberado pro dia todo?    : 
  Garagem liberada?         :  
  EOD;

?>

<div class="container my-3">
  <main>
    <section>
      <a href="index.php?page=autorizacoes">
        <button class="btn btn-success">Voltar</button>
      </a>
    </section>
    <form method="post">
      <div class="row">
        <div class="form-group col-4">
          <label for="">Condominio</label>
          <?= $listacondominios ?>
        </div>
      </div>
      <div class="form-group">
        <label for="">Autorização</label><pre><textarea class="form-control" rows="10" name="autorizacao"><?= $obAutorizacao->autorizacao == '' ? $placeholder : $obAutorizacao->autorizacao ?></textarea></pre>
      </div>
      <div class="row">
        <div class="form-group col-6">
            <label for="data_inicio">Data Inicio</label>
            <input type="date" class="form-control" name="data_inicio" value="<?= $_SERVER['PHP_SELF'] == '/editar.php' ? $obAutorizacao->data_inicio : date('Y-m-d') ?>">
        </div>
        <div class="form-group col-6">
            <label for="data_fim">Data Final</label>
            <input type="date" class="form-control" name="data_fim" value="<?= $_SERVER['PHP_SELF'] == '/editar.php' ? $obAutorizacao->data_fim : date('Y-m-d') ?>">
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
      </div>
    </form>
  </main>