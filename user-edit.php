<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editando dados do usuário</title>
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
                if (!is_logado()) {
                    echo msg_erro("Efetue <a href='user-login.php'>login</a> para editar seus dados!");
                } else {
                    if(!isset($_POST['usuario'])) {
                        include "user-edit-form.php";
                    } else {
                        echo msg_sucesso("Dados foram recebidos");
                    }
                }
            ?>
        </div>
        <?php require_once "rodape.php"; ?>
    </body>
</html>