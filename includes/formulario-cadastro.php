<?php

  $alertaCadastro = strlen($alertaCadastro) ? '<div class="alert alert-danger">'.$alertaCadastro.'</div>' : '';
  
?>
<div class="container my-3">
<main>
  <section>
    <a href="index.php?page=usuario">
        <button class="btn btn-success">Voltar</button>
    </a>
  </section>

  <h2 class="mt-3"><?=TITLE?></h2>
  <div class="container">
    <?=$alertaCadastro?>
  </div>
  <form method="post"> 
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" name="nome" class="form-control <?= $_SERVER['PHP_SELF'] == '/editar.php' ? ' pe-none':''?>" value="<?=$obUsuario->nome?>" require>
        </div>
                        
        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" name="senha" class="form-control" require>
        </div>
        
        <div class="form-group">
          <label for="acesso">Nivel Acesso</label>
          <input type="text" name="nivelacesso" class="form-control" value="<?=$obUsuario->nivelacesso?>" require>
        </div>

        <div class="form-group mt-3">
          <button type="submit" class="btn btn-success">Enviar</button>
        </div>
  </form>

</main>
</div>