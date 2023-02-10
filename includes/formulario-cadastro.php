<?php

  $alertaLogin = strlen($alertaLogin) ? '<div class="alert alert-danger">'.$alertaLogin.'</div>' : '';
  $alertaCadastro = strlen($alertaCadastro) ? '<div class="alert alert-danger">'.$alertaCadastro.'</div>' : '';

?>

<main class="bg-light">
  <div class="text-dark p-3">
    <div class="row">
      <div class="col-6">
          <form method="post">

                <h2>Cadastre-se</h2>

                <?=$alertaCadastro?>

                <div class="form-group">
                  <label for="nome">Nome</label>
                  <input type="text" name="nome" class="form-control" require>
                </div>

                
                <div class="form-group">
                  <label for="senha">Senha</label>
                  <input type="password" name="senha" class="form-control" require>
                </div>
                
                <div class="form-group">
                  <label for="acesso">Nivel Acesso</label>
                  <input type="text" name="acesso" class="form-control" require>
                </div>

                <div class="form-group mt-3">
                  <button type="submit" name="acao" value="cadastrar" class="btn btn-primary">Cadastrar</button>
                </div>

          </form>
      </div>
      <div class="col-6">
      </div>      
    </div>
  </div>
</main>

<!--        
          
-->