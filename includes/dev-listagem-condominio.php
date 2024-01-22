<?php
  
  use App\Controller\Pages\Page;
  use App\Entity\Ocorrencia;
  use App\Entity\Autorizacoes;
  use App\Entity\Condominio;
  use App\Entity\Usuario;
  use App\Utils\View;
  use App\Db\Pagination;
  use App\Session\Login;

  $mensagem = '';
  if (isset($_GET['status'])) {
    switch ($_GET['status']) {
      case "success":
        $mensagem = '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Ação executada com sucesso!</strong>
            <a href="index.php?page=condominio"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
        </div>
        ';
        break;

      case "error":
        $mensagem = '
        <div class="alert text-bg-danger alert-dismissible fade show" role="alert">
            <strong>Ação não executada!</strong>
            <a href="index.php?page=condominio"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
        </div>
        ';
        break;
    }
  }    
?>
<div class="container my-3">
<main>
    <section>
        <?= $mensagem ?>
    </section>

    <section>
        <a href="cadastrar.php?page=condominio">
            <button class="btn btn-success">Novo Cadastro</button>
        </a>
    </section>

    <section class="mt-3">
        <?php

          foreach($condominios as $condominio){
            $content = View::render('dev-resultados-condominio', [
              'ID_CONDOMINIO'       => $condominio->id,
              'NOME_DO_CONDOMINIO'  => $condominio->nome_condominio,
              'COD_CONDOMINIO'      => 'Codigo Interno: '.$condominio->cod_moni,
              'COD_APP'             => !empty($condominio->cod_app) ?
                                        'Codigo APP: '.$condominio->cod_app :
                                        '',
              'FAIXA_IP'            => 'Faixa IP: 192.168.'.$condominio->faixa_ip.'.*',
              'TIPO_ATENDIMENTO'    => $condominio->tipoatendimento,
              'CHAVE_ONE'           => !empty($condominio->chave_one) ?
                                        '<a type="button" class="btn btn-sm btn-outline-info text-info-emphasis"
                                        href="http://192.168.36.250/wsOnePortaria/web/?chave='.$condominio->chave_one.'"
                                        target="_blank">
                                        <img src="img/one-32x32.png" alt="" class="object-fit-contain w-25"> ONE Portaria</img>
                                        </a>' :
                                        '',
              'EQUIPAMENTOS'        => ''
            ]);
            echo $content;
          };

          $resultados = !empty($condominios) ? '' : '<div class="row mt-2 py-2 text-bg-info fw-bold"">
                                                                <div class="col-12 d-flex justify-content-center">
                                                                    Nenhuma condominio encontrado
                                                                </div>
                                                              </div>';
        ?>
        <?= $resultados ?>
    </section>
</main>