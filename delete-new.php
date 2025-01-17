<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Jogo</title>
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $jogo_cod = intval($_POST['jogo'] ?? 0);

                if ($jogo_cod <= 0) {
                    echo msg_erro("Jogo inválido. Selecione um jogo válido para excluir.");
                } else {
                    // Obtém o caminho da capa para excluir o arquivo físico
                    $q = $banco->prepare("SELECT capa FROM jogos WHERE cod = ?");
                    $q->bind_param('i', $jogo_cod);
                    $q->execute();
                    $q->store_result();
                    if ($q->num_rows > 0) {
                        $q->bind_result($capa);
                        $q->fetch();

                        // Exclui o registro do jogo no banco de dados
                        $del = $banco->prepare("DELETE FROM jogos WHERE cod = ?");
                        $del->bind_param('i', $jogo_cod);
                        if ($del->execute()) {
                            // Exclui a capa física, se existir
                            if (!empty($capa) && file_exists("fotos/$capa")) {
                                unlink("fotos/$capa");
                            }
                            echo msg_sucesso("Jogo excluído com sucesso!");
                        } else {
                            echo msg_erro("Erro ao excluir o jogo. Tente novamente.");
                        }
                    } else {
                        echo msg_erro("Jogo não encontrado.");
                    }
                }
            } else {
                require "delete-new-form.php";
            }
        }
        echo voltar();
        ?>
    </div>
    <?php require_once "rodape.php"; ?>
</body>
</html>
