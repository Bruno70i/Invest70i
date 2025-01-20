<?php

// Criar a tabela 'usuarios' se não existir
$db->exec('CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    senha TEXT NOT NULL
)');


// Conectar ao banco de dados SQLite
$db = new SQLite3('meu_banco.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    if ($action === 'register') {
        // Cadastro de usuário
        $stmt = $db->prepare('INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)');
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':senha', $senha);
        $result = $stmt->execute();
        echo json_encode(['message' => 'Usuário cadastrado com sucesso!']);
    } elseif ($action === 'login') {
        // Login de usuário
        $stmt = $db->prepare('SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha');
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':senha', $senha);
        $result = $stmt->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);
        if ($user) {
            echo json_encode(['message' => 'Login bem-sucedido!']);
        } else {
            echo json_encode(['message' => 'Nome de usuário ou senha incorretos.']);
        }
    }
}
