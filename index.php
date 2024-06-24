<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('conexao.php');

    $login = $_POST["login"] ?? null;
    $senha = $_POST["senha"] ?? null;

    if ($login == "" || $login == null) {
        echo "<script language='javascript' type='text/javascript'>
        alert('O campo login deve ser preenchido');window.location.href='index.php';</script>";
        exit();
    }

    $connect = new mysqli("localhost", "admin", "Joao@Vitor123", "usuarios_banco");

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Check if the login already exists
    $query_select = $connect->prepare("SELECT login FROM login WHERE login = ?");
    if ($query_select === false) {
        die("Prepare failed: " . $connect->error);
    }
    $query_select->bind_param("s", $login);
    $query_select->execute();
    $result = $query_select->get_result();

    if ($result->num_rows > 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Esse login já existe');window.location.href='index.php';</script>";
        exit();
    } else {
        // Insert the new user
        $query_insert = $connect->prepare("INSERT INTO login (login, senha) VALUES (?, ?)");
        if ($query_insert === false) {
            die("Prepare failed: " . $connect->error);
        }
        $query_insert->bind_param("ss", $login, $senha);

        if ($query_insert->execute()) {
            echo "<script language='javascript' type='text/javascript'>
            alert('Usuário cadastrado com sucesso!');window.location.href='login.html'</script>";
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Não foi possível cadastrar esse usuário');window.location.href='index.php'</script>";
        }
    }

    $connect->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        *{
            
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .content {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
            padding: 20px;
        }

    #prince{
        width: 450px;
        height: 300px;
        background-color:black;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        color: white;
        border-radius: 30px;
        margin-top: 15%;
    }

    #prince form button{
        width: 180px;
        height: 30px;
        border-radius: 30px;
        margin-left: 3px;
        margin-top: 10px;
    }

    #prince form input{
        width: 180px;
        height: 30px;
        border-radius: 30px;
        align-items: center;
        justify-content: center;
        text-align:center;
    }

    #prince h2{
        font-size: 17px;
    }
    
    

        </style>
</head>
<body>
<div class="banner">
<video class="video-background" autoplay muted loop>
        <source src="background.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>


    <div id="prince">
        <form method="POST" action="">
        <h2>CADASTRO DE USUARIO</h2>
            <label>Login:</label><br><input type="text" name="login" id="login" placeholder="Digite seu usuario para criar"required><br>
            <label>Senha:</label><br><input type="password" name="senha" id="senha" placeholder="Digite sua senha para criar"required><br>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</div>
</body>
</html>
