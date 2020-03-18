<?php 

class Weakness{
	public $energyType;
	public $multiplier;
	public $multipliedDmg;

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