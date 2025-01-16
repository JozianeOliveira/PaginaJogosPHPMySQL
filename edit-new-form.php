<h1>Editar Jogo</h1>
<form action="edit-new.php?cod=<?php echo $jogo['cod']; ?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Jogo:</td>
            <td><input type="text" name="nome" id="nome" size="80" maxlength="80" value="<?php echo $jogo['nome']; ?>" required></td>
        </tr>
        <tr>
            <td>Descrição:</td>
            <td><textarea name="descricao" id="descricao" rows="5" cols="80" required><?php echo $jogo['descricao']; ?></textarea></td>
        </tr>
    </table>
    <button type="submit">Salvar</button>
</form>
