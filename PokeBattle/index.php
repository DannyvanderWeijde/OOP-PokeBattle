<?php  

require "init.php";

//Making a new Pikachu with a nickname.
$Tim = new Pokemon();
$Tim = $Tim->newPokemon("Pikachu","Tim");

//Making a new Charmeleon with a nickname.
$Klaas = new Pokemon();
$Klaas = $Klaas->newPokemon("Charmeleon","Klaas");

//Making the pokemon attack each other once.
$firstAttack = new Battle();
$firstAttack = $firstAttack->attack($Tim,"electric ring",$Klaas,"flare attack");

$secondAttack = new Battle();
$secondAttack = $secondAttack->attack($Tim,"electric ring",$Klaas,"flare attack");

$thirdAttack = new Battle();
$thirdAttack = $thirdAttack->attack($Tim,"electric ring",$Klaas,"flare attack");

//Show the total pokemons that are alive at this moment in time.
$getPopulation = new pokemon;
$getPopulation->getPopulation();