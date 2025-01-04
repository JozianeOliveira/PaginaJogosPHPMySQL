<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Jogo</title>
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
                $nome = trim($_POST['nome'] ?? '');
                $genero = trim($_POST['genero'] ?? '');
                $produtora = trim($_POST['produtora'] ?? '');
                $pais = trim($_POST['pais'] ?? '');
                $descricao = trim($_POST['descricao'] ?? '');
                $nota = trim($_POST['nota'] ?? '');
                $capa = $_FILES['capa'] ?? null;
                if (empty($nome) || empty($genero) || empty($produtora) || empty($pais) || empty($descricao) || empty($nota)) {
                    echo msg_erro("Todos os dados são obrigatórios!");
                } elseif (!is_numeric($nota) || $nota < 0 || $nota > 10) {
                    echo msg_erro("A nota deve ser um número entre 0 e 10.");
                } else {
                    
                    if (!is_dir('fotos')) {
                        mkdir('fotos', 0777, true);  // Cria o diretório 'fotos' se não existir
                    }
                    
                    if ($capa && $capa['error'] === 0) {
                        $extensao = strtolower(pathinfo($capa['name'], PATHINFO_EXTENSION));
                        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
                        if (!in_array($extensao, $extensoes_permitidas)) {
                            echo msg_erro("Extensão de arquivo não permitida.");
                        } else {
                            // Usa o nome original da capa sem gerar um nome único
                            $nome_capa = $capa['name'];
                            $destino = "fotos/$nome_capa";  // Atualiza o caminho para o diretório 'fotos'
                            
                            if (move_uploaded_file($capa['tmp_name'], $destino)) {
                                // Verifica se o gênero já existe na tabela 'generos'
                                $q1 = $banco->prepare("SELECT cod FROM generos WHERE genero = ?");
                                $q1->bind_param('s', $genero);
                                $q1->execute();
                                $q1->store_result();

                                if ($q1->num_rows > 0) {
                                    // Gênero já existe, obtém o cod
                                    $q1->bind_result($genero_cod);
                                    $q1->fetch();
                                } else {
                                    // Gênero não existe, insere novo gênero
                                    $q1 = $banco->prepare("INSERT INTO generos (genero) VALUES (?)");
                                    $q1->bind_param('s', $genero);
                                    if (!$q1->execute()) {
                                        echo msg_erro("Erro ao cadastrar o gênero.");
                                        exit;
                                    }
                                    $genero_cod = $banco->insert_id;  // Obtém o cod do novo gênero
                                }

                                // Verifica se a produtora já existe na tabela 'produtoras'
                                $q2 = $banco->prepare("SELECT cod FROM produtoras WHERE produtora = ? AND pais = ?");
                                $q2->bind_param('ss', $produtora, $pais);
                                $q2->execute();
                                $q2->store_result();

                                if ($q2->num_rows > 0) {
                                    // Produtora já existe, obtém o cod
                                    $q2->bind_result($produtora_cod);
                                    $q2->fetch();
                                } else {
                                    // Produtora não existe, insere nova produtora
                                    $q2 = $banco->prepare("INSERT INTO produtoras (produtora, pais) VALUES (?, ?)");
                                    $q2->bind_param('ss', $produtora, $pais);
                                    if (!$q2->execute()) {
                                        echo msg_erro("Erro ao cadastrar a produtora.");
                                        exit;
                                    }
                                    $produtora_cod = $banco->insert_id;  // Obtém o cod da nova produtora
                                }

                                // Inserção do jogo na tabela 'jogos'
                                $q3 = $banco->prepare("INSERT INTO jogos (nome, descricao, nota, capa, genero, produtora) VALUES (?, ?, ?, ?, ?, ?)");
                                $q3->bind_param('ssdsii', $nome, $descricao, $nota, $nome_capa, $genero_cod, $produtora_cod);

                                if ($q3->execute()) {
                                    echo msg_sucesso("Jogo <strong>$nome</strong> cadastrado com sucesso!");
                                } else {
                                    // Se houver erro na execução
                                    echo msg_erro("Erro ao cadastrar o jogo. Verifique os dados e tente novamente.");
                                    echo "Erro 1: " . $q3->error . "<br>";
                                }
                            } else {
                                echo msg_erro("Falha ao mover a capa para o diretório 'fotos'.");
                            }
                        }
                    } else {
                        echo msg_erro("Erro no envio da capa. Por favor, envie uma imagem válida.");
                    }
                }
            } else {
                require "game-new-form.php";
            }
        }
        echo voltar();
        ?>
    </div>
    <?php require_once "rodape.php"; ?>
</body>
</html>
