<?php 

//This autoloads all the classes that are in the classes folder. NOTE: this online works if the file has the same name as the class within the file.
spl_autoload_register(function($class){
	require_once "classes/{$class}.php";
});