<?php 

class Resistance{
	public $energyType;
	public $multiplier;
	public $newDmgTotal;

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