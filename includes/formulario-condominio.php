<div class="container my-3">
    <main>
        <section>
            <a href="index.php?page=condominio">
                <button class="btn btn-success">Voltar</button>
            </a>
        </section>
        <form method="post">
            <div class="row">
                <div class="form-group">
                    <label for="nome_condominio">Nome do Condominio</label>
                    <input type="text" class="form-control" name="nome_condominio" value="<?=$obCondominio->nome_condominio?>" require>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                        <label for="cod_moni">Codigo Interno</label>
                        <input type="text" class="form-control" name="cod_moni" value="<?=$obCondominio->cod_moni?>" require>
                </div>
                <div class="form-group col-4">
                        <label for="faixa_ip">Faixa de IP</label>
                        <input type="text" class="form-control" name="faixa_ip" value="<?=$obCondominio->faixa_ip?>">
                </div>
                <div class="form-group col-4">
                        <label for="tipoatendimento">Tipo Atendimento</label>
                        <select class="form-select" name="tipoatendimento">
                          <option><?=$obCondominio->tipoatendimento?></option>
                          <option>Portaria 24 Horas</option>
                          <option>Portaria Hibrida</option>
                          <option>Portaria Assistida</option>
                          <option>Em Implantação</option>
                          <option>Descontinuado</option>
                        </select>
                </div>
            </div>                
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>

        </form>

    </main>
</div>