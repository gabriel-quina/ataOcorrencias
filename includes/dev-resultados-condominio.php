<div class="card text-dark mb-2">
  <h5 class="card-header">
    <div class="row">
      <div class="col-4 d-flex align-content-center flex-wrap overflow-hidden"><a class="badge text-warning-emphasis bg-warning-subtle text-bg-info rounded-pill mx-1"
      href="editar.php?page=condominio&id={{ID_CONDOMINIO}}"><i class="bi bi-pencil-square"></i></a>
        {{NOME_DO_CONDOMINIO}}
      </div>
      <div class="col-4 d-flex align-content-center justify-content-evenly flex-wrap">
        {{COD_CONDOMINIO}}
      </div>
      <div class="col-4 d-flex align-content-center justify-content-evenly flex-wrap">
        {{COD_APP}}
      </div>      
    </div>
    <div class="row mt-3">
      <div class="col-4 d-flex align-content-center flex-wrap">
        {{TIPO_ATENDIMENTO}}
      </div>
      <div class="col-4 d-flex align-content-center justify-content-evenly flex-wrap">
        {{FAIXA_IP}}
      </div>
      <div class="col-4 d-flex align-content-center justify-content-evenly flex-wrap">
          {{CHAVE_ONE}}
      </div>
    </div>
  </h5>
  <div class="card-body">
    <div class="accordion accordion-flush" id="accordionFlushExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            {{EQUIPAMENTOS}}
            
          </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
        </div>
      </div>
    </div>
  </div>
</div>