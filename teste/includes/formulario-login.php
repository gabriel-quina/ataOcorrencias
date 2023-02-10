<?php

  $alertaLogin = strlen($alertaLogin) ? '<div class="alert alert-danger">'.$alertaLogin.'</div>' : '';

?>

<main class="bg-light">
  <div class="text-dark p-3">
    <div class="row">
      <div class="col-6">
        <form method="post">
          
          <h2>Login</h2>
          
          <?=$alertaLogin?>
          
          <div class="form-group">
            <label for="nome">Nome de Usuario</label>
            <input type="text" name="nome" class="form-control" require>
          </div>
          
          <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" name="senha" class="form-control" require>
          </div>
          
          <div class="form-group mt-3">
            <button type="submit" name="acao" value="logar" class="btn btn-primary">Entrar</button>
          </div>
          
        </form>
      </div>
      <div class="col-6">
      </div>      
    </div>
  </div>
</main>

<!--        
          <form method="post">

            <h2>Cadastre-se</h2>

            //$alertaCadastro?>

            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" name="nome" class="form-control" require>
            </div>

            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" name="email" class="form-control" require>
            </div>

            <div class="form-group">
              <label for="senha">Senha</label>
              <input type="password" name="senha" class="form-control" require>
            </div>

            <div class="form-group">
              <button type="submit" name="acao" value="cadastrar" class="btn btn-primary">Cadastrar</button>
            </div>

          </form>
-->