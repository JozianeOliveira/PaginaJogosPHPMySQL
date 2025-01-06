<?php
require_once "includes/banco.php";
require_once "includes/login.php";
require_once "includes/funcoes.php";

if (!is_logado()) {
    echo msg_erro('Área restrita! Você precisa estar logado para acessar esta página!');
    exit;
}

$id = $_GET['id'] ?? 0;

$q = $banco->prepare("
    SELECT jogos.nome, 
           jogos.genero AS generos, 
           jogos.produtora AS produtoras,
           jogos.descricao, 
           jogos.nota, 
           jogos.capa 
    FROM jogos
    WHERE jogos.cod = ?  ");
    
$q->bind_param('i', $id);  
$q->execute();
$result = $q->get_result();


if ($result->num_rows < 1) {
    echo msg_erro("Jogo não encontrado.");
    exit;
}

$dados = $result->fetch_assoc();
?>

<h1>Editar Jogo</h1>
<form action="edit-new.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
    <table>
        <tr><td>Jogo: <td><input type="text" name="nome" id="nome" size="80" maxlength="80" value="<?= $dados['nome'] ?>" required>
        <tr><td>Gênero: <td><input type="text" name="genero" id="genero" size="80" maxlength="80" value="<?= $dados['genero'] ?>" required>
        <tr><td>Produtora: <td><input type="text" name="produtora" id="produtora" size="80" maxlength="80" value="<?= $dados['produtora'] ?>" required>
        <tr><td>Descrição: <td><textarea name="descricao" id="descricao" rows="5" cols="80" required><?= $dados['descricao'] ?></textarea>
        <tr><td>Nota: <td><input type="number" name="nota" id="nota" step="0.1" min="0" max="10" value="<?= $dados['nota'] ?>" required>
        <tr><td>Capa: <td><input type="file" name="capa" id="capa" accept="image/*">
        <tr><td colspan="2">Deixe em branco para manter a capa atual.
    </table>
    <button type="submit">Salvar Alterações</button>
</form>
<?= voltar() ?>
