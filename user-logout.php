<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logout</title>
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
                logout();
                echo msg_sucesso('Usuário desconectado com sucesso!');
                echo voltar();
            ?>
        </div>
        <?php require_once "rodape.php"; ?>
    </body>
</html>