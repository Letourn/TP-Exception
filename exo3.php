<?php
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
$saisie = (int) readline();
echo $saisie . "\n";
// Test de la note
try {
    print $i->validerNote( $saisie );
}
catch (OutOfRangeException $ex) {
    echo ("une erreur s'est produite\n");
    echo ($ex->getMessage());
}