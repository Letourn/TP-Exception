<?php

class TemperatureException extends Exception {
    // Attributs
    private $temp;
    private $tempMax;

    // Constructeur
    public function __construct($message, $temp, $tempMax) {
        parent::__construct($message);
        $this->temp = $temp;
        $this->tempMax = $tempMax;
    }

    // Accesseurs
    public function GetTemp() {
        return $this->temp;
    }

    public function GetTempMax() {
        return $this->tempMax;
    }
}

?>