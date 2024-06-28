<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('conexao.php');

    $login = $_POST["login"] ?? null;
    $senha = $_POST["senha"] ?? null;

    if (empty($login)) {
        echo "<script language='javascript' type='text/javascript'>
        alert('O campo login deve ser preenchido');window.location.href='index.php';</script>";
        exit();
    }

    if (empty($senha)) {
        echo "<script language='javascript' type='text/javascript'>
        alert('O campo senha deve ser preenchido');window.location.href='index.php';</script>";
        exit();
    }

    $connect = new mysqli("localhost", "admin", "Joao@Vitor123", "usuario_banco");

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    $stmt = $connect->prepare("SELECT * FROM login WHERE login = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $connect->error);
    }
    
    $stmt->bind_param("s", $login);
    
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $login = $result->fetch_assoc();
        if (password_verify($senha, $login['senha'])) {
            $_SESSION['login'] = $login['login'];
            $_SESSION['id'] = $login['id'];
            echo "<script language='javascript' type='text/javascript'>
            alert('Login successful');window.location.href='doc.php';</script>";
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Senha incorreta');window.location.href='index.php';</script>";
        }
    } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Usuário não encontrado');window.location.href='index.php';</script>";
    }

    $stmt->close();
    $connect->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login pet.br</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
