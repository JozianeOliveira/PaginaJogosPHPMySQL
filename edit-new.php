<?php
require_once "includes/banco.php";
require_once "includes/login.php";
require_once "includes/funcoes.php";

if (!is_logado()) {
    echo msg_erro('Área restrita! Você precisa estar logado para acessar esta página!');
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo msg_erro("Jogo inválido ou não encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
    $genero = trim(filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS));
    $produtora = trim(filter_input(INPUT_POST, 'produtora', FILTER_SANITIZE_SPECIAL_CHARS));
    $descricao = trim(filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS));
    $nota = filter_input(INPUT_POST, 'nota', FILTER_VALIDATE_FLOAT);
    $capa = $_FILES['capa'] ?? null;

    if (empty($nome) || empty($genero) || empty($produtora) || empty($descricao) || $nota === false) {
        echo msg_erro("Todos os campos são obrigatórios e a nota deve ser um número entre 0 e 10.");
        exit;
    }

    // Tratamento de upload de capa
    $nome_capa = $capa['error'] === 0 ? basename($capa['name']) : null;
    if ($nome_capa) {
        $extensao = strtolower(pathinfo($nome_capa, PATHINFO_EXTENSION));
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($extensao, $extensoes_permitidas)) {
            echo msg_erro("Extensão de arquivo inválida.");
            exit;
        }
        if (!move_uploaded_file($capa['tmp_name'], "fotos/$nome_capa")) {
            echo msg_erro("Erro ao salvar a nova capa.");
            exit;
        }
    }

    // Atualiza os dados no banco
    $q = $banco->prepare("UPDATE jogos SET nome = ?, genero = ?, produtora = ?, descricao = ?, nota = ?, capa = IFNULL(?, capa) WHERE cod = ?");
    $q->bind_param('sssssssi', $nome, $genero, $produtora, $descricao, $nota, $nome_capa, $id);

    if ($q->execute()) {
        echo msg_sucesso("Jogo <strong>$nome</strong> atualizado com sucesso!");
    } else {
        echo msg_erro("Erro ao atualizar o jogo: " . $q->error);
    }
}

echo voltar();
?>
