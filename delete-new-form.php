<h1>Excluir Jogo</h1>
<form action="delete-new.php" method="post">
    <table>
        <tr>
            <td>Selecione o Jogo:</td>
            <td>
                <select name="jogo" id="jogo" required>
                    <?php
                    require_once "includes/banco.php";
                    $q = "SELECT cod, nome FROM jogos ORDER BY nome";
                    $busca = $banco->query($q);
                    if (!$busca) {
                        echo "<option value=''>Erro ao carregar jogos</option>";
                    } else {
                        while ($reg = $busca->fetch_object()) {
                            echo "<option value='{$reg->cod}'>{$reg->nome}</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <button type="submit">Excluir</button>
</form>
