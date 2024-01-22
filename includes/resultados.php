<div class="row mt-2 <?= $ocorrencia->tipo_ocorrencia == 'Técnica' ? 'bg-warning' : 'bg-primary-subtle' ?> border-primary-subtle rounded-start rounded-end">
    <div class="col-4 col-xl-4 column-gap-1 d-flex align-items-center ">
        <span class="text-dark fw-bold text-uppercase" id="<?= $ocorrencia->id ?>">
            <?= $ocorrencia->nome_condominio ?>
        </span>
        <span <?= $lida ?: 'hidden' ?> class="badge text-bg-success rounded-pill">
            <i class="bi bi-check"></i>
        </span>
        <a <?= !$lida ?: 'hidden' ?> class="link-dark badge bg-warning-subtle"            
            href="ler.php?id=<?= $ocorrencia->id ?>"
        >
            <small>
                <i class="bi bi-eye-fill"></i>
            </small>
        </a>
    </div>
    <div class="col-3 col-xl-3 d-flex column-gap-1 align-items-center justify-content-center">
        <small>
            <span class="badge text-bg-secondary text-wrap">
            Criado por: <?= ucwords($ocorrencia->criado_por_nome) ?> | Em: <?= $criado_em->format('d-m-Y H:i') ?>
            </span>
        </small>
    </div>
    <div class="col-3 col-xl-3 d-flex column-gap-1 align-items-center justify-content-center">
        <small <?= $modificado_em == $criado_em ? 'hidden' : '' ?>>
            <span class="badge text-bg-secondary text-wrap">
            Editado por: <?= ucwords($ocorrencia->modificado_por_nome) ?> | Em: <?= $modificado_em->format('d-m-Y H:i') ?>
            </span>
        </small>
    </div>
    <div class="col-2 d-flex align-items-center justify-content-center <?= $status ?> rounded-end">
        <span class="badge">Situação<br><?= $ocorrencia->status ?></span>
    </div>
</div>
<div class="row text-bg-light pb-2 rounded-start rounded-end">
    <div style="white-space: pre-wrap;" class="col-10 word-wrap text-break p-2"><p class="lh-sm"><?= $ocorrencia->ocorrencia ?></p>
    </div>
    <div class="col-2 border-start border-2 my-2 d-flex align-content-center justify-content-evenly flex-wrap">
        <a href="editar.php?page=ata&id=<?= $ocorrencia->id ?>" <?= $ocorrencia->status == "Resolvido" ? 'hidden' : '' ?>>
            <button type="button" class="btn btn-sm btn-primary my-2">Editar</button>
        </a>
        <a href="resolver.php?id=<?= $ocorrencia->id ?>" <?= $ocorrencia->status == "Resolvido" ? 'hidden' : '' ?>>
            <button type="button" class="btn btn-sm btn-outline-success my-2">Resolver</button>
        </a>
    </div>
    <div class="col">
        <div class="row border-top border-2 mx-1 py-1">
            <div class="col-2 col-lg-1 d-flex">
                <small>
                    <span class="badge p-1 text-dark">Lido por:</span>
                </small>            
            </div>
            <div class="col-4 col-lg-2 d-flex me-auto align-content-center justify-content-center flex-wrap">
                <small>    
                    <div class="float-right"><?= $leitores != '' ? $leitores : '<span class="badge bg-secondary flex-wrap">Nenhuma Leitura Registrada</span>' ?></div>
                </small>
            </div>
        </div>
        <div class="col">
            <div class="row mx-2">
                <div class="col-2 col-lg-1 d-flex">

                </div>
            </div>
        </div>
    </div>
</div>