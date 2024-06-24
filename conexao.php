<?php
$host = 'localhost';
$usuario =  'admin';
$senha = 'Joao@Vitor123';
$banco = 'usuarios_banco';


$mysqli = new mysqli($host, $usuario, $senha, $banco);

if($mysqli->connect_error){
    die('Falha ao tentar conectar ao banco!');
} else {
    echo "Conexão 100% estabelecida";
}

$mysqli -> close();
?>