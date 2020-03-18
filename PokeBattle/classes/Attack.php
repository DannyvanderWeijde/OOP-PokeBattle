<?php 

class Attack{
	public $attackMoves; 
	public $pokemons;
	public $checkIfNotDead;
	public $weaknessDmg;
	public $resistanceDmg;
	public $pokemonId = 0;
	public $pokemon;
	public $oppositePokemon;
	public $type; 

	public function pokemonAttack($firstPokemon,$firstAttMove,$secondPokemon,$secondAttMove){
		$this->checkIfNotDead = $this->checkHP($firstPokemon,$secondPokemon);
		
		if($this->checkIfNotDead){
			$this->attackMoves[0] = $this->attackInfo($firstPokemon,$firstAttMove);
			$this->attackMoves[1] = $this->attackInfo($secondPokemon,$secondAttMove);
			foreach($this->attackMoves as $attackMove){
				if($this->pokemonId == 0){
					$this->attackingPokemon = $firstPokemon;
					$this->oppositePokemon = $secondPokemon;
					$this->type = $firstPokemon->energyType;
				}else{
					$this->attackingPokemon = $secondPokemon;
					$this->oppositePokemon = $firstPokemon;
					$this->type = $secondPokemon->energyType;
				}

				$this->weaknessDmg = new Weakness();
				$this->weaknessDmg = $this->weaknessDmg->checkWeakness($attackMove,$this->oppositePokemon,$this->type);

				$this->resistanceDmg = new Resistance();
				$this->resistanceDmg = $this->resistanceDmg->checkResistance($attackMove,$this->oppositePokemon,$this->type);

				echo $this->oppositePokemon->nickName . " has " . $this->oppositePokemon->currentHitPoints . " HP <br> " .$this->attackingPokemon->nickName . " attacks " . $this->oppositePokemon->nickName . " with a(n) " . $attackMove[0] . ".<br>";

				if($this->resistanceDmg || $this->weaknessDmg){
					if($this->resistanceDmg){
						$this->oppositePokemon->currentHitPoints = $this->oppositePokemon->currentHitPoints - $this->resistanceDmg;

						echo $this->attackingPokemon->nickName . "'s " . $attackMove[0] . " was not very affective and dealt " . $this->resistanceDmg . " damage to " . $this->oppositePokemon->nickName . " <br> " . $this->oppositePokemon->nickName . " now has " . $this->oppositePokemon->currentHitPoints . " HP Left <br><br>";
					}else{
						$this->oppositePokemon->currentHitPoints = $this->oppositePokemon->currentHitPoints - $this->weaknessDmg;

						echo $this->attackingPokemon->nickName . "'s " . $attackMove[0] . " was very affective and dealt " . $this->weaknessDmg . " damage to " . $this->oppositePokemon->nickName . " <br> " . $this->oppositePokemon->nickName . " now has " . $this->oppositePokemon->currentHitPoints . " HP Left <br><br>";
					}
				}else{
					$this->oppositePokemon->currentHitPoints = $this->oppositePokemon->currentHitPoints - $attackMove[1];
					echo $this->attackingPokemon->nickName . "'s " . $attackMove[0] . " dealt " . $attackMove[1] . " damage to " . $this->oppositePokemon->nickName . " <br> " . $this->oppositePokemon->nickName . " now has " . $this->oppositePokemon->currentHitPoints . " HP Left <br><br>";
				}
				
				$this->pokemonId++;
			}
			echo "<br>";
		}else{
			echo "One of or both pokemons have 0 or less HP which makes them unable to battle. <br><br><br>";
		}
	}

	public function attackInfo($pokemon,$attackMove){
		foreach($pokemon->attacks as $attack){
			if($attack[0] == $attackMove){
				return $attack;
			}
		}
	}

	public function checkHP($firstPokemon,$secondPokemon){
		$this->pokemons[0] = $firstPokemon;
		$this->pokemons[1] = $secondPokemon;

		foreach ($this->pokemons as $pokemon) {
			if($pokemon->currentHitPoints <= 0){
				return false;
				die();
			}
		}
		return true;
	}
}