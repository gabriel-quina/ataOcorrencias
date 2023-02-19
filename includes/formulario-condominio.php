<div class="container my-3">
    <main>

        <section>
            <a href="index.php?page=condominio" class="btn btn-success">Voltar</a>
        </section>
        <h2 class="mt-3"><?=TITLE?></h2>

        <form method="post">

            <div class="form-group">
                <label for="nome_condominio">Nome do Condominio</label>
                <input type="text" class="form-control" name="nome_condominio" value="<?=$obCondominio->nome_condominio?>">
            </div>
            <div class="form-group">
                <label for="cod_moni">Codigo Moni</label>
                <input type="text" class="form-control" name="cod_moni" value="<?=$obCondominio->cod_moni?>">
            </div>
            <div class="form-group">
                <label for="cod_moni">Link One</label>
                <input type="text" class="form-control" name="one_integracao" value="<?=$obCondominio->one_integracao?>">
            </div>
            
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>

        </form>

    </main>
    </div>