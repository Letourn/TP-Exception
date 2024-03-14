# TP Exception en PHP

## Exercice 1 

***Écrire le code suivant et l'éxecuter en ligne de commande***

```php
(int) $num = 10;
(int) $den = 0;
(int) $fraction = $num / $den;
```

### Quel est le problème ?

Ici une erreur est retournée car la division par 0 est impossible 

### Quelle exception est levée ? 

```
Uncaught DivisionByZeroError: Division by zero in /home/noe/TP-Exception-PHP/TP.php:5
Stack trace:
#0 {main}
  thrown in /home/noe/TP-Exception-PHP/TP.php on line 5
```

Une erreur est signalée à la ligne 5 



***Entrer et exécuter le code suivant***

```php
function add(int $x, int $y)
{
 return $x + $y;
}
$value = add('Type', 10);
```

### Quel est le problème ?

Ici la fonction demande en entrée deux variables de type int, cependant lors de l'appel de la fonction il est entré un variable de type String 

### Quelle exception est levée ?

```
PHP Fatal error:  Uncaught TypeError: add(): Argument #1 ($x) must be of type int, string given, called in /home/noe/TP-Exception-PHP/TP.php on line 12 and defined in /home/noe/TP-Exception-PHP/TP.php:8
Stack trace:
#0 /home/noe/TP-Exception-PHP/TP.php(12): add()
#1 {main}
  thrown in /home/noe/TP-Exception-PHP/TP.php on line 8
```
Il y a une erreur à la ligne 8 lors de l'appel de la fonction avec une variable de mauvais type

***Entrer et exécuter le code suivant***

```php
intdiv(PHP_INT_MIN, -1);
```

### Quel est le problème ?

La division du nombre minimum possible par php par -1 donne donc un nombre positif qui dépasse le nombre maximum possible par php, il lui est donc impossible de retourner ce nombre 

### Quelle exception est levée ?

```
PHP Fatal error:  Uncaught ArithmeticError: Division of PHP_INT_MIN by -1 is not an integer in /home/noe/TP-Exception-PHP/TP.php:14
Stack trace:
#0 /home/noe/TP-Exception-PHP/TP.php(14): intdiv()
#1 {main}
  thrown in /home/noe/TP-Exception-PHP/TP.php on line 14
```

Le nombre étant trop grand php ne le traite pas comme un entier, la fonction qui permet de diviser retournant que un entier, il lui est donc impossible de retourner ce nombre 


***Entrer et exécuter le code suivant***

```php
(array) $T_int = [1, 2, 3, 4, 5 ];
(int) $n = $T_int[6];
```

### Quel est le problème ?
On définit la variable $n sur la 6 cellule du tableau, cependant le tableau s'arrête uniquement à la cellule 4.

### Quelle exception est levée ?

```
PHP Warning:  Undefined array key 6 in /home/noe/TP-Exception-PHP/TP.php on line 18
```
La cellule 6 du tableau n'est pas définie 


## **Exercice 2** 

***Taper le code suivant, puis le tester en CLI***

```php
// on affiche toutes les erreurs
ini_set("error_reporting", E_ALL);
ini_set("display_errors", "on");
$var = [];
// clé inconnue
print $var["abcd"];
// division par zéro
$var = 7 / 0;
var_dump($var);
// tableau à bornes fixes
$array = new \SplFixedArray(5);
$array[1] = 2;
$array[4] = "foo";
// indice en-dehors des bornes
$array[5] = 8;
// vérification
print "ce message ne sera pas affiché\n";
```

### Le message de vérification est-il affiché ?
Non

### Pourquoi ?
Il y a une erreur dans le script avant que le message ne s'affiche 

### Où pourrait on voir l'erreur ?
L'erreur se trouve ligne 9, lors de la division par 0, on remarque également un Warning lorsque l'on demande l'affichage de la cellule "abcd" du tableau $var[].

***Modifier le code précédant en y ajoutant un try... catch***
```php
// on affiche toutes les erreurs
ini_set("error_reporting", E_ALL);
ini_set("display_errors", "on");
// on entoure le code par un try / catch
try {
  $var = [];
  // clé inconnue
  print $var["abcd"];
  // division par zéro
  $var = 7 / 0;
  var_dump($var);
  // tableau à bornes fixes
  $array = new \SplFixedArray(5);
  $array[1] = 2;
  $array[4] = "foo";
  // indice en-dehors des bornes
  $array[5] = 8;
  // vérification
  print "ce message ne sera pas affiché\n";
} catch (\Error $ex) {
  // \Error est l'interface implémentée par le type Error
  // on affiche l'erreur
  print "erreur, message: " . $ex->getMessage() . ", type: " . get_class($ex) . "\n";
}
```

### Le message de vérification est-il affiché ?
Le message est bien affiché 
### Pourquoi ?
Le message est affiché car le code contenu dans le try a rencontré une erreur donc le catch est exécuté permettant de retourner le message d'erreur
### Que provoque ce bloc try ... catch ?
Le try... catch permet de tester le code contenu dans le try, puis en cas d'erreur exécuter le code contenu dans le catch

***Écrire et exécuter le code suivant*** 
```php
// on affiche toutes les erreurs
ini_set("error_reporting", E_ALL);
ini_set("display_errors", "on");
// un tableau à bornes fixes
$array = new \SplFixedArray(5);
try {
 // indice en-dehors des bornes
 $array[5] = 8;
} catch (\Throwable $ex) {
 // affichage message d'erreur Le message de vérification est-il affiché?

 print "Erreur 1: " . $ex->getMessage() . "\n";
}
try {
 // indice en-dehors des bornes
 $array[5] = 8;
} catch (\Exception $ex) {
 // affichage message d'erreur
 print "Erreur 2: " . $ex->getMessage() . "\n";
}
try {
 // indice en-dehors des bornes
 $array[5] = 8;
} catch (\RuntimeException $ex) {
 // affichage message d'erreur
 print "Erreur 3: " . $ex->getMessage() . "\n";
}
try {
 // division par 0
 intdiv(5, 0);
} catch (\Throwable $ex) {
 // affichage message d'erreur
 print "Erreur 4: " . $ex->getMessage() . "\n";
}
try {
 // division par 0
 intdiv(5, 0);
} catch (\DivisionByzeroError $ex) {
 // affichage message d'erreur
 print "Erreur 5: " . $ex->getMessage() . "\n";
}
try {
 // division par 0
 intdiv(5, 0);
} catch (\Error $ex) {
 // affichage message d'erreur
 print "Erreur 6: " . $ex->getMessage() . "\n";
}
try {
 // division par 0
 intdiv(5, 0);
} catch (\Exception $ex) {
 // affichage message d'erreur
 print "Erreur 6: " . $ex->getMessage() . "\n";
}
```

### Quelles différences dans l'exécution du code par rapport au précédent ?
On retrouve les différents types d'erreur, avec chaque erreur affichée via un message, le code ne s'arrête pas lors de la première erreur

### Quels sont les différents types d'erreurs qui sont attrapés (catch) ?
Il y a deux types d'erreurs : 
```
Index invalid or out of range
Division by zero
```

## Exercice 3

***Écrire le code suivant*** 

```php
class Program
{
    public function validerNote( int $note )
{
        if ( $note < 0 || $note > 20)
    {
        throw new Exception("Note invalide");
    }
        else {
            return true;
        }
}
}
```

***Créer une instance de la classe Program et utliser la méthode ValiderNote pour vérifier la note saisie***

```php
// Instance
$i = new Program();
// Saisie
echo "Saisissez une note entre 1 et 20\n";
$saisie = (int) readline();
// Test de la note
print $i->validerNote( $saisie );
```

### A quelle ligne de code l’exception est-elle instanciée ?

L'exception est instanciée à la ligne 8

### A quelle ligne de code le programme s’interrompt-il ?

Lors de la ligne 8 
```
PHP Fatal error:  Uncaught Exception: Note invalide in /home/noe/TP-Exception-PHP/exo3.php:8
Stack trace:
#0 /home/noe/TP-Exception-PHP/exo3.php(21): Program->validerNote()
#1 {main}
  thrown in /home/noe/TP-Exception-PHP/exo3.php on line 8
```


***Modifier le code en ajoutant un try catch afin d'éviter l'interruption du code***

```php
class Program
{
    public function validerNote( int $note )
{
        if ( $note < 0 || $note > 20)
    {
        $i = new Exception("Note invalide\n");
        throw $i;
    }
        else{
            return true;
        }
}
}
// Instance
$i = new Program();
// Saisie
echo "Saisissez une note entre 1 et 20\n";
$saisie = (int) readline();
// Test de la note
try {
    print $i->validerNote( $saisie );
    }
catch (\Exception $i) {
    print $i->getMessage(); 
}
```

***Utiliser l'exception OutOfRangeException***

```php
class Program
{
    public function validerNote( int $note )
{
        if ( $note < 0 || $note > 20)
    {
        throw new OutOfRangeException("note " . $note . " non valide\n");
    }
        else{
            return true;
        }
}
}
// Instance
$i = new Program();
// Saisie
echo "Saisissez une note entre 1 et 20\n";
// (int) permet de convertir la saisie en int
$saisie = (int) readline();
// Test de la note
try {
    print $i->validerNote( $saisie );
}
catch (OutOfRangeException $ex) {
    echo ("une erreur s'est produite\n");
    echo ($ex->getMessage());
}
```


## Exercice 4
### Activité 1 :

***Créer la classe Four dans un dossier à part avec ses attributs temperature et tempMax***
```php
class Four {
    private $temperature;
    private $tempMax;
}
```

***Y ajouter des accesseurs setTemperature et getTemperature***

```php
    private function setTemperature($temperature) {
        $this->temperature = $temperature;
    }   
    public function getTemperature() {
        return $this->temperature;
    }
```

***Créer un constructeur avec pour paramètre temperature***

```php 
    public function __construct($temperature) {
        $this->SetTemperature($temperature);
        $this->tempMax = 100;
    }
```



***Créer une méthode ToString() qui retourne une description du four sous la forme: Four : 20°***

```php
    public function ToString() {
        return "Four : " . $this->getTemperature() . "°";
    }
```

**Voilà ce que donne la classe Four pour le moment**
```php
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
}
```

***Créer une instance de la classe Four, créez un four à 20° et affichez***
```php
// Création d'une instance de la classe Four avec une température de 20°
$four = new Four(20);

// Affichage du four
echo $four->ToString() . "\n";
```

### Activité 2 :

***Créer la méthode Chauffer() permettant d'ajouter des degrés à l'objet Four***

```php
    // Méthode Chauffer
    public function Chauffer($degres) {
        $temperature = $this->temperature + $degres;
        $this->setTemperature($temperature);
    }
```

***Idem pour Refroidir sauf qu’elle diminue la température du four de la valeur de degres***

```php
    // Méthode Refroidir
    public function Refroidir($degres) {
        $temperature = $this->temperature - $degres;
        $this->setTemperature($temperature);
    }
```

***Maintenant faire appel à ces méthodes pour chauffer et refroidir le four et afficher les degrés à chaque fois***
```php
// Création d'une instance de la classe Four avec une température de 20°
$four = new Four(20);

// Affichage du four
echo $four->ToString() . "\n";

// Chauffer le four de 10°
$four->Chauffer(20);

// Affichage du four
echo $four->ToString() . "\n";

// refroidir le four de 10°
$four->Refroidir(20);

// Affichage du four
echo $four->ToString() . "\n";
```

***Ajoutez une méthode AfficherMenu() qui va proposer à l’utilisateur un menu.***

```php
    public function AfficherMenu(): int
    {
        echo("Menu du four \n****\n");
        echo("1 - chauffer le four\n");
        echo("2 - refroidir le four\n");
        echo("3 - quitter \n");
        return intval( readline() );
    }
```

***Maintenant faire appel à cette méthode pour afficher le menu***

```php
$choix = ' ';
while ($choix != '3') {

    $four->AfficherMenu();

    $choix = readline()[0];
    switch ($choix) {
        case '1':
            // faire chauffer le four de 10°
            $four->Chauffer(20); 
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
```

### Est-il possible de dépasser la température maximale du four ?

Oui c'est possible de dépasser la température maximale

### Activité 4

***Dans un autre fichier, créer la classe TemperatureException qui hérite de Exception, avec ses deux attributs $temp et $tempMax***

```php
class TemperatureException extends Exception {
    // Attributs
    private $temp;
    private $tempMax;
}
```

***Créer les deux accesseurs en lecture GetTemp() et GetTempMax() et son constructeur***

```php 
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
```

### Dans quelle méthode de la classe Four va-on apporter cette modification ? 
On doit apporter les modifications à la méthode Chauffer()

***Lancer TemperatureException lorsque la température du four
dépasse la température maximale***

```php
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
```

***Dans le script principal, il faut donc encadrer l’appel de la méthode qui fait chauffer le four par un bloc try catch.***

```php
    // faire chauffer le four de 10°
    // Tester la chauffe avec un bloc try-catch
    try {
        $four->Chauffer(20);
    } catch (TemperatureException $e) {
        echo "Exception attrapée: " . $e->getMessage() . "\n";
        echo "Température maximale : " . $e->GetTempMax() . "°\n";
        echo "Température actuelle : " . $e->GetTemp() . "°\n";
    };
```
