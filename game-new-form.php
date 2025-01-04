<h1>Novo Jogo</h1>
<form action="game-new.php" method="post" enctype="multipart/form-data">
    <table>
        <tr><td>Jogo: <td><input type="text" name="nome" id="nome" size="80" maxlength="80" required>
        <tr><td>Gênero: <td><input type="text" name="genero" id="genero" size="80" maxlength="80" required>
        <tr><td>Produtora: <td><input type="text" name="produtora" id="produtora" size="80" maxlength="80" required>
        <tr><td>País: <td><input type="text" name="pais" id="pais" size="80" maxlength="80" required>        
        <tr><td>Descrição: <td><textarea name="descricao" id="descricao" rows="5" cols="80" required></textarea>
        <tr><td>Nota: <td><input type="number" name="nota" id="nota" step="0.1" min="0" max="10" required>
        <tr><td>Capa: <td><input type="file" name="capa" id="capa" accept="image/*" required>
    </table>
    <button type="submit">Salvar</button>
</form>
