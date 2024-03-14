<?php

class Four {
    private $temperature;
    private $tempMax;

    public function __construct($temperature) {
        $this->SetTemperature($temperature);
        $this->tempMax = 100;

    }

    private function setTemperature($temperature) {
        $this->temperature = $temperature;
    }

    public function getTemperature() {
        return $this->temperature;
    }

    // Méthode Chauffer
    public function Chauffer($degres) {
        $temperature = $this->temperature + $degres;
        if ($temperature > $this->tempMax) {
            throw new TemperatureException("Température maximale dépassée", $temperature, $this->tempMax);
            // On bloque la température à la température Max
            $temperature = $this->tempMax;
            $this->setTemperature($temperature);
        }
        else {
            $this->setTemperature($temperature);
        }
    }
    
    // Méthode Refroidir
    public function Refroidir($degres) {
        $temperature = $this->temperature - $degres;
        $this->setTemperature($temperature);
    }

    public function AfficherMenu(): int
    {
        echo("Menu du four \n****\n");
        echo("1 - chauffer le four\n");
        echo("2 - refroidir le four\n");
        echo("3 - quitter \n");
        return intval( readline() );
    }

    public function ToString() {
        return "Four : " . $this->getTemperature() . "°";
    }
}

require ('TempException.php');

// Création d'une instance de la classe Four avec une température de 20°
$four = new Four(20);

// Affichage du four
echo $four->ToString() . "\n";

$choix = ' ';
while ($choix != '3') {

    $four->AfficherMenu();

    $choix = readline()[0];
    switch ($choix) {
        case '1':
            // faire chauffer le four de 10°
            // Tester la chauffe avec un bloc try-catch
            try {
                $four->Chauffer(20);
            } catch (TemperatureException $e) {
                echo "Exception attrapée: " . $e->getMessage() . "\n";
                echo "Température maximale : " . $e->GetTempMax() . "°\n";
                echo "Température actuelle : " . $e->GetTemp() . "°\n";
            };
            break;
        case '2':
            // refroidir le four de 10°
            $four->Refroidir(20);
            break;
        case '3':
            echo "Au revoir\n";
            break;
        default :
            echo "Mauvais choix\n";
            break;
    }
    // Affichage du four pour information
    echo $four->ToString() . "\n";
}
?>
