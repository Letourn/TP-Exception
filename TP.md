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
### Activité 1

***Créer la classe Four dans un dossier à part avec ses attributs temperature et tempMax***
```php
class Four
{
    public function temperature() {

    }

    public function tempMax()
    {

    }
}
```

***Y ajouter des accesseurs setTemperature et getTemperature***

```php
    private function setTemperature ($temp) {
        $temp = readline ();
    }

    public function getTemperature ($temp) {
        echo $temp;
    }
```

***Créer un constructeur avec pour paramètre temperature***

```php 

```