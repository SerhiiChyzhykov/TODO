<?php 

$root_autoloader = function($class){
	if(is_file($f = $class . '.php')){
		include $f;
	}
};

$controller_autoloader = function($class){
	if(is_file($f = 'controller/' . $class . '.php')){
		include $f;
	}
};

spl_autoload_register($root_autoloader);
spl_autoload_register($controller_autoloader);
