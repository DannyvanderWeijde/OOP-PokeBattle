<?php 

class Pokemon{
	public function newPokemon($pokemon,$nickName){
		$newPokemon = new $pokemon();
		$newPokemon->nickName = $nickName;
		return $newPokemon;
	}
}