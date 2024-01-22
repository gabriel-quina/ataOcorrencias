<?php
  
  use App\Controller\Pages\Page;
  use App\Entity\Ocorrencia;
  use App\Entity\Autorizacoes;
  use App\Entity\Condominio;
  use App\Entity\Usuario;
  use App\Utils\View;
  use App\Db\Pagination;
  use App\Session\Login;

  date_default_timezone_set('America/Sao_Paulo');

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

  $listacondominios = '';
  foreach ($condominios as $condominio) {
      $active = '';
      if (isset($_GET['condominios'])) {
          $active = $_GET['condominios'] == $condominio->nome_condominio ? 'selected' : '';
      }
      $listacondominios .= '<option ' . $active . '>' . $condominio->nome_condominio . '</option>';
  }

  $gets = http_build_query($_GET);
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

    <section>
        <form method="get">

          <div class="row">
              <input type="hidden" name="page" value="condominio">
              <div class="form-group col-4 col-lg-6">
                  <label for="">Filtrar Condominio</label>
                  <select class="form-select" name="condominios">
                      <option>Todos</option>
                      <?= $listacondominios ?>
                  </select>
              </div>
              <div class="form-group col-4 col-lg-4">
                  <label>Tipo Atendimento</label>
                  <select class="form-select" name="tipo_atendimento">
                      <option <?= $filtroTipoAtendimento == 'tipoatendimento = "Portaria 24 Horas"' ? 'selected' : '' ?>>24 Horas</option>                           
                      <option <?= $filtroTipoAtendimento == 'tipoatendimento = "Portaria Assistida"' ? 'selected' : '' ?>>Assistida</option>
                      <option <?= $filtroTipoAtendimento == 'tipoatendimento = "Portaria Hibrida"' ? 'selected' : '' ?>>Hibrida</option>
                      <option <?= $filtroTipoAtendimento == 'tipoatendimento != "Todos"' ? 'selected' : ''; ?>>Todos</option>
                  </select>
              </div>                    
              <div class="col-2 col-lg-1 d-flex align-items-end justify-content-center">
                  <button type="submit" class="btn btn-primary btn-sm lh-1">Aplicar Filtro</button>
              </div>
              <div class="col-2 col-lg-1 d-flex align-items-end justify-content-center">
                  <a href="index.php?page=condominio">    
                      <div class="btn btn-light btn-sm lh-1">Limpar Filtro</div>
                  </a>
              </div>
          </div>

        </form>
    </section>

    <section class="mt-3">
        <?php

          foreach($condominios as $condominio){
            $content = View::render('resultados-condominio', [
              'ID_CONDOMINIO'       => $condominio->id,
              'NOME_DO_CONDOMINIO'  => $condominio->nome_condominio,
              'ENDERECO'            => $condominio->endereco,
              'COD_CONDOMINIO'      => $condominio->cod_moni,
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
                                        ''
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