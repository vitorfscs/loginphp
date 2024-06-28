<?php
 include('conexao.php');

 interface IAnimais {
    public function setCadela($cadela);
    public function getCadela();
    public function setGato($gato);
    public function getGato();
    public function setHamster($hamster);
    public function getHamster();
}


class Animais implements IAnimais {
    private $cadela;
    private $gato;
    private $hamster;

    public function setCadela($cadela) {
        $this->cadela = $cadela;
    }

    public function getCadela() {
        return $this->cadela;
    }

    public function setGato($gato) {
        $this->gato = $gato;
    }

    public function getGato() {
        return $this->gato;
    }

    public function setHamster($hamster) {
        $this->hamster = $hamster;
    }

    public function getHamster() {
        return $this->hamster;
    }
}

$animais = new Animais();
$animais->setCadela($_POST['cachorro'] ?? null);
$animais->setGato($_POST['gato'] ?? null);
$animais->setHamster($_POST['hamster'] ?? null);


?>