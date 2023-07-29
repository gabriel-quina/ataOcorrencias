"use strict";

document.onreadystatechange = function () {

  if (document.readyState == "complete") {
    const queryString = window.location;
    const urlParams = new URLSearchParams(queryString.search);
    const urlCheck = queryString.pathname;
    console.log(urlCheck);
    const myModal = new bootstrap.Modal(document.getElementById("modalCondominio"), { backdrop: 'static', keyboard: false });
    if (
      urlCheck.match('index.php') != null &&
      urlParams.has('id') &&
      (urlParams.get('page') == 'condominio' || urlParams.get('page') == 'ata')
    ) {
      myModal.toggle(myModal);
    };

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

  }
}