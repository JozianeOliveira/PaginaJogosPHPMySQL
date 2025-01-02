<h1>Novo jogo</h1>
<form action="game-new.php" method="post">
    <table>
        <tr><td>Jogo <td><input type="text" name="nome" id="nome" size="80" maxlength="80">
        <tr><td>Gênero <td><input type="text" name="genero" id="genero" size="80" maxlength="80">
        <tr><td>Produtora <td><input type="text" name="produtora" id="produtora" size="80" maxlength="80">
        <tr><td>Descrição<td><textarea name="descricao" id="descricao" rows="20" cols="80"></textarea>
        <tr><td>Nota <td><input type="text" name="nota" id="nota" size="80" maxlength="80">
        <tr><td>Capa <td><input type="file" name="capa" id="capa" accept="image/*">
    </table>
    <input type="submit" value="Salvar">
</form>
