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
                    if (!isset($_POST['usuario'])) {
                        require "user-new-form.php";
                    } else {
                        $usuario = $_POST['usuario'] ?? null;
                        $nome = $_POST['nome'] ?? null;
                        $senha1 = $_POST['senha1'] ?? null;
                        $senha2 = $_POST['senha2'] ?? null;
                        $tipo = $_POST['tipo'] ?? null;

                        if ($senha1 === $senha2) {
                            echo msg_sucesso("Tudo certo para salvar");
                        } else {
                            echo msg_erro("Senhas não conferem. Repita o procedimento.");
                        }
                    }
                }

                echo voltar();
            ?>
        </div>
    </body>
</html>