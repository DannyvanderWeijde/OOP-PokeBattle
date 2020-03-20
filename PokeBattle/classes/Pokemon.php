<?php 

class Pokemon{
	public static $livingPokemonCount = 0;

	//This creates a new pokemon and adds it to the living pokemon count total.
	public function newPokemon($pokemon,$nickName){
		$newPokemon = new $pokemon();
		$newPokemon->nickName = $nickName;
		$this->addOrRemovePokemon("add");
		return $newPokemon;
	}

	//This shows the living pokemon count.
	public function getPopulation(){
		echo "At this moment there are/is " . self::$livingPokemonCount . " pokemon(s) alive. ";
	}

	//This adds or removes a pokemon to the living pokemon count.
	public function addOrRemovePokemon($property){
		if($property == "add"){
			self::$livingPokemonCount++;
		}else if($property == "dead"){
			self::$livingPokemonCount--;
		}
	}
}