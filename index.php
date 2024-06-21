<?php 
include('conexao.php');
session_start(); // Start the session at the beginning

if (isset($_POST['usuario']) && isset($_POST['senha'])) {

    if (strlen($_POST['usuario']) == 0) {
        echo "Preencha seu usuario";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);
 
        // Use prepared statements to prevent SQL injection
        $stmt = $mysqli->prepare("SELECT * FROM usuarios_banco WHERE usuario = ? AND senha = ?");
        $stmt->bind_param("ss", $usuario, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $usuario_data = $result->fetch_assoc();

            $_SESSION['usuario'] = $usuario_data['id'];
            header("Location: feed.php");
            exit(); // Make sure to exit after redirect
        } else {
            echo "Usuario ou Senha incorretos, Tente novamente.";
        }

        $stmt->close(); // Close the prepared statement
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div id="Content-int"> 
        <form action="login.php" method="POST"> 
            <label>Usuario</label>
            <input type="text" id="usuario" name="usuario">
            <label>Senha</label>
            <input type="password" id="senha" name="senha">
            <br>
            <button type="submit" id="submit">Login</button>
        </form>
    </div>
</body>
</html>