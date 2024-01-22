<div class="card text-dark mb-2">
  <h5 class="card-header">
    <div class="row">
      <a class="h-50 badge text-warning-emphasis bg-warning-subtle text-bg-info rounded-pill mx-1"
      style="width: 40px;"
      href="editar.php?page=condominio&id={{ID_CONDOMINIO}}"><i class="bi bi-pencil-square"></i></a>
      <div class="col-4 d-flex align-content-center flex-wrap overflow-hidden">        
        <div class="accordion accordion-flush bg-transparent d-flex align-content-center" id="accordionID{{ID_CONDOMINIO}}">              
        <button class="accordion-button collapsed bg-transparent" type="button"
                data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ID_CONDOMINIO}}"
                aria-expanded="false" aria-controls="flush-collapse{{ID_CONDOMINIO}}">
                <h5 class="px-2">{{COD_CONDOMINIO}} - {{NOME_DO_CONDOMINIO}}</h5>
        </button>
        </div>              
      </div>            
      <div class="col-4 d-flex align-content-center justify-content-evenly flex-wrap">
        {{TIPO_ATENDIMENTO}}
      </div>
      <div class="col-3 d-flex align-content-center justify-content-evenly flex-wrap">
        {{CHAVE_ONE}}
      </div>
    </div> 
  </h5>
  <div class="card-body">
    <div class="accordion accordion-flush" id="accordionID{{ID_CONDOMINIO}}">
      <div class="accordion-item">
        <div id="flush-collapse{{ID_CONDOMINIO}}" class="accordion-collapse collapse" data-bs-parent="#accordionID{{ID_CONDOMINIO}}">
          <div class="accordion-body">   
            <strong>Informações:</strong>        
            <p>
              {{ENDERECO}}
            </p>
            <p>
              {{FAIXA_IP}}
            </p>
            <p>
              {{COD_APP}}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>