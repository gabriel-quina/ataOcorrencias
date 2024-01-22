"use strict"

console.log('Working')

document.onreadystatechange = function () {
  if (document.readyState == "complete") {
    console.log('Loaded')
    const queryString = window.location;
    const urlParams = new URLSearchParams(queryString.search);
    const urlCheck = queryString.pathname;
    const placehoder = document.querySelector("[name='tipoOcorrencia']")
    const txtArea = document.querySelector("[name='ocorrencia']")
    /*txtArea.value = "Informações da ATA"

    placehoder.addEventListener("change", e => {
      switch (placehoder.value) {
        case 'Informativa':
          txtArea.value = "Alguma informação relevante"
          break;
        case 'Tecnica':
          txtArea.value = "Algum problema técnico"
          break;
      }
    })*/
    
    if (
      urlCheck.match('cadastrar.php') != null &&
      urlParams.has('id') &&
      (urlParams.get('page') == 'condominio' || urlParams.get('page') == 'ata')
    ) {
      myModal.toggle(myModal);
    };

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

  }
}