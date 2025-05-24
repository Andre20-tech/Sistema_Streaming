<?php
$host = '127.0.0.1';
$db   = 'SF';
$user = 'root';
$pass = 'Pikadoandre2121'; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=3307;dbname=$db;charset=$charset";


try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo 'Erro na conexão: ' . $e->getMessage();
    exit();
}
?>
