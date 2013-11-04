<?php

require_once("lebewesen.php");

class Mensch extends Lebewesen {
    
    private $_name;
    private $_geschlecht;
    
    function __construct($name, $geschlecht) {
        $this->_name = $name;
        $this->_geschlecht = $geschlecht;
        $this->setAlter($this->getAlter()+1);
    }
    function __destruct() {
        echo 'dead';
    }
    
    public function altern() {
        $this->setAlter($this->getAlter()+1);
    }
    
    public function getName() {
        return $this->_name;
    }
    
    public function umbenennen($name) {
        $this->name = $name;
    }
    
    public function geburtstagFeiern() {
        $this->setAlter($this->getAlter()+1);
        echo 'Party!';
    }
    
    private static $__vorfahre = 'Ape';
    
    public static function neueEvolutionstheorie($vorfahre) {
        Mensch::$__vorfahre = $vorfahre;
    }
    public static function getVorfahre() {
        return Mensch::$__vorfahre;
    }
    
    
}


?>