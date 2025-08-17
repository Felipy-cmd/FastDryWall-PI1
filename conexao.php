
<?php
// === Configuração de logs ===
ini_set('display_errors', 0);
ini_set('log_errors', 1);

$logDir = __DIR__ . '/logs';
if (!is_dir($logDir)) {
    @mkdir($logDir, 0755, true);
}
ini_set('error_log', $logDir . '/php-errors.log');
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
$host = "sql105.infinityfree.com";       // Host do MySQL
$user = "if0_39722261";                  // Usuário do MySQL
$pass = "X703dBxMzd";      // Senha do painel InfinityFree
$db   = "if0_39722261_fastdrywall01";    // Nome do banco de dados

$conn = new mysqli($host, $user, $pass, $db);

// Verificação de erro
if ($conn->connect_error) {
    die("❌ Erro na conexão com o banco: " . $conn->connect_error);
} 