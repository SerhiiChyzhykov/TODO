<?php 

class App{
	public $router;
	public $content;
	public $conn;

	public function __construct(){
		try
		{
			require 'config.php';
			$host = $config['mysql.host'];
			$db = $config['mysql.db'];
			$user = $config['mysql.user'];
			$password = $config['mysql.password'];
			$this->conn = new PDO("mysql:dbname=$db;host=$host","$user","$password");
		}
		catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";

			echo"Not installed. Run <a href=setup>Setup</a> first.";
		}
	}

	public function dispatch(){
		$this->router = new Router($_SERVER['REQUEST_URI']);
	}

	public function go(){
		list($controller, $method) = $this->router->getAction();
		$c = new $controller;
		$this->content = $c->$method();
	}

	public function render(){
		include 'tpl/header.php';
		include 'tpl/body.php';
		include 'tpl/footer.php';
	}
}
