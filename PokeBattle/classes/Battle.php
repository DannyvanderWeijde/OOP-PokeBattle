<?php 

class Battle{
	private $attackMoves; 
	private $pokemons;
	private $weaknessDmg;
	private $resistanceDmg;
	private $pokemonId = 0;
	private $attackingPokemon;
	private $oppositePokemon;
	private $type; 

	//Make the attacks happend.
	public function attack($firstPokemon,$firstAttMove,$secondPokemon,$secondAttMove){
		if($this->checkHP($firstPokemon,$secondPokemon)){
			$this->attackMoves[0] = $this->attackInfo($firstPokemon,$firstAttMove);
			$this->attackMoves[1] = $this->attackInfo($secondPokemon,$secondAttMove);
			foreach($this->attackMoves as $attackMove){
				if($this->checkHP($firstPokemon,$secondPokemon)){
					if($this->pokemonId == 0){
						$this->attackingPokemon($firstPokemon,$secondPokemon);
					}else{
						$this->attackingPokemon($secondPokemon,$firstPokemon);
					}

					$this->weaknessDmg($attackMove);
					$this->resistanceDmg($attackMove);
					$this->hitPointsBeforeAttack($this->attackingPokemon,$this->oppositePokemon,$attackMove[0]);

					if($this->resistanceDmg || $this->weaknessDmg){
						if($this->resistanceDmg){
							$this->resistanceAttack($attackMove);
						}else{
							$this->weaknessAttack($attackMove);
						}
					}else{
						$this->normalAttack($attackMove);
					}

					$this->pokemonId++;
				}else{
					echo $secondPokemon . " died so he could not use his move. ";
				}
				if($this->oppositePokemon->currentHitPoints <= 0){
					$this->pokemonDiedInBattle();
				}
			}
			echo "<br>";
		}else{
			echo "One of or both pokemons have 0 or less HP which makes them unable to battle. <br><br><br>";
		}
	}

	//Checks if the pokemons have more than 0 hp. If they don't they can't fight and attack.
	public function checkHP($firstPokemon,$secondPokemon){
		$this->pokemons[0] = $firstPokemon;
		$this->pokemons[1] = $secondPokemon;

		foreach($this->pokemons as $pokemon){
			if($pokemon->currentHitPoints <= 0){
				return false;
				die();
			}
		}
		return true;
	}

	//Echos the HP of the pokemon that is gonna get attacked.
	public function hitPointsBeforeAttack($attackingPokemon,$oppositePokemon,$attackMove){
		echo $oppositePokemon->nickName . " has " . $oppositePokemon->currentHitPoints . " HP <br> " .$attackingPokemon->nickName . " attacks " . $oppositePokemon->nickName . " with a(n) " . $attackMove . ".<br>";
	}

	//Puts one of the attacks in the array where both attacks are gonna get saves.
	public function attackInfo($pokemon,$attackMove){
		foreach($pokemon->attacks as $attack){
			if($attack[0] == $attackMove){
				return $attack;
			}
		}
	}

	//Saves the attacking pokemon, the opposite pokemon and the move that the enery type of the attacking pokemon.
	public function attackingPokemon($attPokemon,$defPokemon){
		$this->attackingPokemon = $attPokemon;
		$this->oppositePokemon = $defPokemon;
		$this->type = $attPokemon->energyType;
	}

	//Checks if the opposite pokemon is weak to the attackers energy type.
	public function weaknessDmg($attackMove){
		$this->weaknessDmg = new Weakness();
		$this->weaknessDmg = $this->weaknessDmg->checkWeakness($attackMove,$this->oppositePokemon,$this->type);
	}

	//Checks if the opposite pokemon resists the attackers energy type.
	public function resistanceDmg($attackMove){
		$this->resistanceDmg = new Resistance();
		$this->resistanceDmg = $this->resistanceDmg->checkResistance($attackMove,$this->oppositePokemon,$this->type);
	}

	//If the opposite pokemon is weak to the attacking pokemons type it deals extra damage and shows the correct text.
	public function weaknessAttack($attackMove){
		$this->oppositePokemon->currentHitPoints = $this->oppositePokemon->currentHitPoints - $this->weaknessDmg;

		echo $this->attackingPokemon->nickName . "'s " . $attackMove[0] . " was very affective and dealt " . $this->weaknessDmg . " damage to " . $this->oppositePokemon->nickName . " <br> " . $this->oppositePokemon->nickName . " now has " . $this->oppositePokemon->currentHitPoints . " HP Left <br><br>";
	}

	//If the opposite pokemon resists the attacking pokemons type it deals less damage and shows the correct text.
	public function resistanceAttack($attackMove){
		$this->oppositePokemon->currentHitPoints = $this->oppositePokemon->currentHitPoints - $this->resistanceDmg;

		echo $this->attackingPokemon->nickName . "'s " . $attackMove[0] . " was not very affective and dealt " . $this->resistanceDmg . " damage to " . $this->oppositePokemon->nickName . " <br> " . $this->oppositePokemon->nickName . " now has " . $this->oppositePokemon->currentHitPoints . " HP Left <br><br>";
	}

	//If the opposite pokemon is neutral to the attacking pokemons type it deals the normal amount of damage and shows the correct text.
	public function normalAttack($attackMove){
		$this->oppositePokemon->currentHitPoints = $this->oppositePokemon->currentHitPoints - $attackMove[1];

		echo $this->attackingPokemon->nickName . "'s " . $attackMove[0] . " dealt " . $attackMove[1] . " damage to " . $this->oppositePokemon->nickName . " <br> " . $this->oppositePokemon->nickName . " now has " . $this->oppositePokemon->currentHitPoints . " HP Left <br><br>";
	}

	//If a pokemon dies this removes the pokemon from the living pokemon count.
	public function pokemonDiedInBattle(){
		$death = new Death();
		$death->pokemonDied();
	}
}