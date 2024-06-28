<?php
include('conexao.php');
include('cad_idanimal.php');

class Animais {
}

class ListarAnimais extends Animais {

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listar() {
        $sql = "SELECT * FROM Animais";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . " - Idade: " . $row["idade"] . " - Espécie: " . $row["animal"] . "<br>";
            }
        } else {
            echo "0 resultados";
        }
    }
}

$listarAnimais = new ListarAnimais($conn);
$listarAnimais->listar();

$conn->close();
?>