<?php 

class Weakness{
	public $energyType;
	public $multiplier;
	public $multipliedDmg;

	//This checks if the opposite pokemon is weak to the attacking pokemons energy type and if so calculates the damage the attack is gonna do.
	public function checkWeakness($attackMove,$oppositePokemon,$type){
		$this->energyType = $oppositePokemon->weakness[0];
		if($this->energyType == $type){
			$this->multiplier = $oppositePokemon->weakness[1];
			$this->multipliedDmg = $this->multiplier * $attackMove[1];
			return $this->multipliedDmg;
		}
		return false;
	}
}