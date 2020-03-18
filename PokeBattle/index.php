<?php  

require "init.php";

//Making a new Pikachu with a nickname.
$Tim = new Pokemon();
$Tim = $Tim->newPokemon("Pikachu","Tim");

//Making a new Charmeleon with a nickname.
$Klaas = new Pokemon();
$Klaas = $Klaas->newPokemon("Charmeleon","Klaas");

//Making the pokemon attack each other once.
$firstAttack = new Attack();
$firstAttack = $firstAttack->pokemonAttack($Tim,"electric ring",$Klaas,"flare attack");

$secondAttack = new Attack();
$secondAttack = $secondAttack->pokemonAttack($Tim,"electric ring",$Klaas,"flare attack");

$thirdAttack = new Attack();
$thirdAttack = $thirdAttack->pokemonAttack($Tim,"electric ring",$Klaas,"flare attack");