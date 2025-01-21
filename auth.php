<?php

// Caminho absoluto para o banco de dados
$dbPath = __DIR__ . '/meu_banco.db';

try {
    // Verificar se o arquivo do banco de dados existe, caso contrário criar
    if (!file_exists($dbPath)) {
        $db = new PDO('sqlite:' . $dbPath);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Criar a tabela de usuários
        $db->exec("CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            senha TEXT NOT NULL
        )");

        echo json_encode(["sucesso" => "Banco de dados criado com sucesso."]);
    } else {
        // Criar a conexão com o banco de dados existente
        $db = new PDO('sqlite:' . $dbPath);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
} catch (PDOException $e) {
    die(json_encode(["erro" => "Erro ao configurar o banco de dados: " . $e->getMessage()]));
}

// Verificar o método da requisição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    $nome = $input['nome'] ?? '';
    $senha = $input['senha'] ?? '';

    if (empty($nome) || empty($senha)) {
        echo json_encode(["erro" => "Nome e senha são obrigatórios."]);
        exit;
    }

    if ($action === 'register') {
        try {
            $stmt = $db->prepare('INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)');
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();
            echo json_encode(["sucesso" => "Usuário registrado com sucesso."]);
        } catch (PDOException $e) {
            echo json_encode(["erro" => "Erro ao registrar o usuário: " . $e->getMessage()]);
        }
    } elseif ($action === 'login') {
        try {
            $stmt = $db->prepare('SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha');
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                echo json_encode(["sucesso" => "Login realizado com sucesso."]);
            } else {
                echo json_encode(["erro" => "Nome de usuário ou senha incorretos."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["erro" => "Erro ao realizar o login: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["erro" => "Ação inválida."]);
    }
} else {
    echo json_encode(["erro" => "Método não suportado."]);
}

?>
