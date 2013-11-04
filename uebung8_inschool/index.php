<?php

require_once("mensch.php");
$mensch = new Mensch('Ben Hur', "männlich");
echo $mensch->getName() . "</br>";
$mensch->umbenennen('Ben');
echo "Alter: " . $mensch->getAlter() . "<br/>";
if (is_a($mensch, 'Mensch')) {
    echo "Ist Mensch<br/>";
} else {
    echo "Ist kein Mensch<br/>";
}
echo "Vorfahre: " . Mensch::getVorfahre() . "<br/>";
Mensch::neueEvolutionstheorie('Affen');
echo "Vorfahre: " . Mensch::getVorfahre() . "<br/>";

$schweizer = new Schweizer("Sandy", "weiblich");
$schweizer->umbenennen("Barabra");

?>