<?php 

//These are all Pikachu's stats.
class Pikachu{
	public $name = "Pikachu";
	public $nickName;
	public $energyType = "lightning";
	public $hitPoints = 60;
	public $currentHitPoints = 60;
	public $attacks = [["electric ring", 60],["pika punch", 20]];
	public $weakness = ["fire", 1.5];
	public $resistance = ["fighting", 20];
}