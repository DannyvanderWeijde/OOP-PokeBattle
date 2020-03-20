<?php 

class Resistance{
	public $energyType;
	public $multiplier;
	public $newDmgTotal;

	//This checks if the opposite pokemon resists the attacking pokemons energy type and if so calculates the damage the attack is gonna do.
	public function checkResistance($attackMove,$oppositePokemon,$type){
		$this->energyType = $oppositePokemon->resistance[0];
		if($this->energyType == $type){
			$this->multiplier = $oppositePokemon->resistance[1];
			$this->newDmgTotal = $this->multiplier - $resistance[1];
			return $this->newDmgTotal;
		}
		return false;
	}
}