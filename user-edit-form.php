<h1>Alteração de Dados</h1>
<form action="user-edit.php" method="post">
    <table>
        <tr><td>Usuário
            <td><input type="text" name="usuario" id="usuario" maxlength="10" size="10">
        <tr><td>Nome
            <td><input type="text" name="nome" id="nome" maxlength="30" size="30">
        <tr><td>Tipo
            <td><input type="text" name="tipo" id="tipo" readonly>
        <tr><td>Senha
            <td><input type="password" name="senha1" id="senha1" maxlength="10" size="10">
        <tr><td>Confirme a senha 
            <td><input type="password" name="senha2" id="senha2" maxlength="10" size="10">
        <tr><td><input type="submit" value="Salvar">
    </table>
</form>