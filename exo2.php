<?php
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