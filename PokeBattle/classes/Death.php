<?php

//This removes the pokemon from the living pokemon count.
class Death extends Pokemon{
	public function pokemonDied(){
		$this->addOrRemovePokemon("dead");
	}
}