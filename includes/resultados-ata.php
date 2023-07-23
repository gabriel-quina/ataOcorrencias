<div id="referenceid<?= $ocorrencia->id ?>" class="row mt-2 bg-primary-subtle border-primary-subtle rounded-start rounded-end">
  <div class="col-5 col-xl-6 column-gap-1 d-flex align-items-center ">
        <a class="link-dark fw-bold text-uppercase" href="index.php?page=ata&id=<?= $ocorrencia->id_condominio ?>#referenceid<?= $ocorrencia->id ?>">
            <?= $ocorrencia->nome_condominio ?> | <em><?= $ocorrencia->cod_moni ?></em>
        </a>
        <span <?= $lida ?: 'hidden' ?> class="badge text-bg-success rounded-pill" data-bs-toggle="tooltip" data-bs-title="Ocorrencia lida">
            <i class="bi bi-check"></i>
        </span>
        <a <?= !$lida ?: 'hidden' ?> class="link-dark badge bg-warning-subtle" data-bs-toggle="tooltip" data-bs-title="Marcar como lida"            
            href="ler.php?id=<?= $ocorrencia->id ?>"
            <small>
                <i class="bi bi-eye-fill"></i>
            </small>
        </a>
    </div>
    <div class="col-5 col-xl-4 d-flex column-gap-1 align-items-center justify-content-center">
        <small>
            <span class="badge rounded-pill text-bg-secondary text-wrap">Data inicio:
            <?= $ocorrencia->data_inicio ?></span>
        </small>
        <small>
        <span class="badge rounded-pill text-bg-secondary text-wrap">Data final:
            <?= $ocorrencia->data_fim ?></span>
        </small>
    </div>
    <div class="col-2 d-flex align-items-center justify-content-center <?= $status ?> rounded-end">
        <span class="badge">Situação<br><?= $ocorrencia->status ?></span>
  </div>
</div>
<div class="row text-bg-light pb-2 rounded-start rounded-end">
    <div style="white-space: pre-wrap;" class="col-10 word-wrap text-break p-2"><?= $ocorrencia->ocorrencia ?>
    </div>
    <div class="col-2 border-start border-2 my-2 d-flex align-content-center justify-content-evenly flex-wrap">
        <a href="editar.php?page=ata&id=<?= $ocorrencia->id ?>">
            <button type="button" class="btn btn-sm btn-primary my-2">Editar</button>
        </a>
        <a href="excluir.php?page=ata&id=<?= $ocorrencia->id ?>">
            <button type="button" class="btn btn-sm btn-danger my-2"">Excluir</button>
        </a>
    </div>
    <div class="col ">
        <div class="row border-top border-2 mx-2">
            <div class="col-2 col-lg-1 d-flex">
                <a class="link-dark">
                    <small>
                        <span class="badge p-1 rounded text-dark">Lido por:</span>
                    </small>
                </a>
            </div>
            <div class="col-4 col-lg-2 d-flex me-auto align-content-center justify-content-center flex-wrap">
              <small>    
                <div class="float-right"><?= $leitores != '' ? $leitores : '<span class="badge bg-secondary flex-wrap">NENHUMA LEITURA REGISTRADA</span>' ?></div>
              </small>
            </div>
        </div>
        <div class="col ">
            <div class="row mx-2">
                <div class="col-2 col-lg-1 d-flex">

                </div>
            </div>
        </div>
    </div>
</div>