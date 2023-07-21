       
    </div> <!-- CLOSE CONTAINER -->
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 bg-light border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a class="navbar-brand mx-2" target="_blank" href="https://castsegjuizdefora.com.br/">
            <img src="img/castseg.png" alt="" height="35">
            </a>
          <span class="mb-3 mb-md-0 text-muted">© <?= date('Y')?> <!--Gabriel Quina--></span>
        </div>
        <!--<ul class="nav col-md-4 justify-content-end list-unstyled d-flex mx-2">
          <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-twitter" width="24" height="24"></i></a></li>
          <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-instagram" width="24" height="24"></i></a></li>
          <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-facebook" width="24" height="24"></i></a></li>
        </ul>-->
      </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
  <div class="modal fade" id="modalCondominio" tabindex="-1" aria-labelledby="modalCondominio" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content vh-100">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-dark" id="ToggleLabel">Plano B</h1>
                    <a href="index.php?page=<?=$_GET['page']?>" class="btn btn-close"></a>
                </div>
                <div class="modal-body h-100">                    
                    <?=  $modalContent ?>
                </div>
                <div class="modal-footer">
                    <div class="h-100 p-3 overflow-auto">
                    </div>
                </div>
            </div>
        </div>
  </div>
</html>