<?php

abstract class Lebewesen {
    public abstract function altern();
    private $_alter;
  
    protected function setAlter($alter) {
        $this->_alter = $alter;
    }  
    public function getAlter() {
        return $this->_alter;
    }
}

?>