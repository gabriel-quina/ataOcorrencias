<div class="card text-dark mb-2">
  <h5 class="card-header">
    <div class="row">
      <div class="col-4">
      <?= $autorizacao->condominio ?>
      </div>
      <div class="col-6">
        <span class="badge rounded-pill text-bg-secondary text-wrap">Data inicio:
        <?= $data_inicio->format('d-m-Y') ?></span>
        <span class="badge rounded-pill text-bg-secondary text-wrap">Data final:
        <?= $data_fim->format('d-m-Y') ?></span>
      </div>
      <div class="col-2 d-flex align-content-center justify-content-evenly flex-wrap">
        <a href="editar.php?page=autorizacoes&id=<?= $autorizacao->id ?>">
          <button type="button" class="btn btn-sm btn-primary mb-2">
            Editar
          </button>
        </a>
        <!--<a href="excluir.php?page=autorizacoes&id=<?= $autorizacao->id ?>">
          <button type="button" class="btn btn-sm btn-danger mb-2">
            Excluir
          </button>
        </a>-->
      </div>  
    </div>
  </h5>
  <div class="card-body">
    <p style="white-space: pre-wrap;" class="card-text word-wrap text-break font-monospace"><?= $autorizacao->autorizacao ?></p>
  </div>
</div> 