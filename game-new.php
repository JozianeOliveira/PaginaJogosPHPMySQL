<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar novo Usuário</title>
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
                if (!is_admin()) {
                    echo msg_erro('Área restrita! Você não é administrador!');
                } else {
                    if (!isset($_POST['jogo'])) {
                        require "game-new-form.php";
                    } else {
                        $nome = $_POST['nome'] ?? null;
                        $genero = $_POST['genero'] ?? null;
                        $produtora = $_POST['produtora'] ?? null;
                        $descricao = $_POST['descricao'] ?? null;
                        $nota = $_POST['nota'] ?? null;
                        $capa = $_POST['capa'] ?? null;

                    }
                }

                echo voltar();
            ?>
        </div>
        <?php require_once "rodape.php"; ?>
    </body>
</html>