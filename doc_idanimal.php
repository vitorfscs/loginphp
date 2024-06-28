<?php
    include('conexao.php');
    include('cad_idanimal.php');

    class Pesquisa extends Animais{

        $sql = "SELECT * FROM Animais";
        $result = $conn->query($sql);

    }

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()) {
            echo "ID : ". $row["id"]. "- Nome : ". $row["nome"]. " - IDADE : ". $row["idade"]. " - ESPÉCIE : ". $row["animal"]. "<br>";
        }
    } else{
        echo "0 resultados";
    }
    $conn->close();

?>