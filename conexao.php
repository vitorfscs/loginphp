<?php
$host = '127.0.0.1';
$usuario = 'admin';
$senha = 'V1]6SF5AS82SjE*j';
$db = 'usuarios_banco'; // Replace with your actual database name

// Create a new mysqli object with the correct parameters
$mysqli = new mysqli($host, $usuario, $senha, $db);

// Check for connection errors
if ($mysqli->connect_error) {
    die("Falha ao conectar: " . $mysqli->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}
?>