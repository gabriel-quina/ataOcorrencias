<div class="container my-3">
<main>

    <h2 class="mt-3">Excluir</h2>

    <form method="post">

        <div class="form-group">
            <p>Você deseja realmente excluir?</p>
        </div>

        <div class="form-group mt-3">
            <a href=<?='index.php?page='.$_GET['page'].' '?>>
                <button type="button" class="btn btn-success">Cancelar</button>
            </a>

            <button type="submit" class="btn btn-danger" name="excluir">Excluir</button>
        </div>

    </form>

</main>
</div>