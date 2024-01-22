<?php

$mensagem = '';
  if (isset($_GET['status'])) {
    switch ($_GET['status']) {
      case "success":
          $mensagem = '
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Ação executada com sucesso!</strong>
              <a href="editarusuario.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
          </div>
          ';
          break;

      case "error":
          $mensagem = '
          <div class="alert text-bg-danger alert-dismissible fade show" role="alert">
              <strong>Ação não executada!</strong>
              <a href="editarusuario.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
          </div>
          ';
          break;

      case "errorPassword":
        $mensagem = '
        <div class="alert text-bg-danger alert-dismissible fade show" role="alert">
            <strong>A senha antiga não está correta ou as senhas novas não são iguais!</strong>
            <a href="editarusuario.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
        </div>
        ';
        break;
    }
  }

?>
<div class="container my-3">
<main>
  <h2 class="mt-3">Editar Usuário</h2>
  <div class="container">
    <?= $mensagem ?>
  </div>
  <form method="post">

        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" name="nome" class="form-control pe-none" value="<?=$obUsuario->nome?>" require>
        </div>
        <div class="form-group">
          <label for="senha">Senha Antiga</label>
          <input type="password" name="senha" class="form-control" require>
        </div>                        
        <div class="form-group">
          <label for="senha">Nova Senha</label>
          <input type="password" name="novasenha" class="form-control" require>
        </div>
        <div class="form-group">
          <label for="confirmasenha">Confirmar Nova Senha</label>
          <input type="password" name="confirmasenha" class="form-control" require>
        </div>
        
        <!--<div class="form-group">
          <label for="acesso">Nivel Acesso</label>
          <input type="text" name="nivelacesso" class="form-control pe-none" value="<?=$obUsuario->nivelacesso?>">
        </div>-->

        <div class="form-group mt-3">
          <button type="submit" class="btn btn-success">Enviar</button>
        </div>

  </form>

  
</main>
</div>