<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jogo</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body>
    <?php
    require_once "includes/banco.php";
    require_once "includes/login.php";
    require_once "includes/funcoes.php";
    ?>
    <div id="corpo">
        <?php
   
        $cod = isset($_GET['cod']) ? (int)$_GET['cod'] : 0;

        if ($cod) {
            
            $q = $banco->prepare("SELECT * FROM jogos WHERE cod = ?");
            $q->bind_param('i', $cod);
            $q->execute();
            $resultado = $q->get_result();

            if ($resultado->num_rows > 0) {
                $jogo = $resultado->fetch_assoc();
                require "edit-new-form.php"; 
            } else {
                echo msg_erro("Jogo não encontrado!");
            }
        } else {
            echo msg_erro("Código inválido!");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $descricao = trim($_POST['descricao'] ?? '');

            if (empty($nome) || empty($descricao)) {
                echo msg_erro("Todos os dados são obrigatórios!");
            } else {
            
                $q3 = $banco->prepare("UPDATE jogos SET nome = ?, descricao = ? WHERE cod = ?");
                $q3->bind_param('ssi', $nome, $descricao, $cod);
                if ($q3->execute()) {
                    echo msg_sucesso("Jogo atualizado com sucesso!");
                } else {
                    echo msg_erro("Erro ao atualizar o jogo.");
                }
            }
        } 
        echo voltar();
        ?>
    </div>
    <?php require_once "rodape.php"; ?>
</body>
</html>
