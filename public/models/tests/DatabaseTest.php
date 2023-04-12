<?php
require_once __DIR__ . '/../config/DatabaseModel.php';

$database = new \App\Config\Database();
$conn = $database->getConnection();

if ($conn) {
    echo "Conexão estabelecida com sucesso!";
} else {
    echo "Falha ao conectar ao banco de dados.";
}
?>