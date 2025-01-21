<?php
// Definir o caminho do banco de dados SQLite3
$dbPath = 'meu_banco.db';

// Verificar se o arquivo do banco de dados existe
if (!file_exists($dbPath)) {
    die(json_encode(["erro" => "Banco de dados não encontrado."]));
}

// Criar a conexão com o banco de dados SQLite3
try {
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(["erro" => "Erro ao conectar ao banco de dados: " . $e->getMessage()]));
}

// Exemplo de uso
try {
    $db->exec("CREATE TABLE IF NOT EXISTS exemplo (id INTEGER PRIMARY KEY, nome TEXT)");
    echo json_encode(["sucesso" => "Tabela criada ou já existe."]);
} catch (PDOException $e) {
    die(json_encode(["erro" => "Erro ao executar consulta: " . $e->getMessage()]));
}
?>
