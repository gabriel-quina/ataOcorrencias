<tr>
    <td>
        <h6 id="referenceId<?=$condominio->id?>"><?= $condominio->nome_condominio ?></h6>
    </td>
    <td><?= $one ?></td>
    <td><?= $condominio->cod_moni ?></td>
    <td class="text-center">
        <a href="editar.php?page=condominio&id=<?= $condominio->id ?>"
        class="btn btn-primary">Editar</a>
        <a href="excluir.php?page=condominio&id=<?= $condominio->id ?>"
        class="btn btn-danger">Excluir</a>
    </td>
</tr>