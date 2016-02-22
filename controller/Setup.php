<?php

class Setup
{
	public function Setup()
	{
		if(!isset($config['db']))
		{
			if(isset($config['mysql'])) {
				$config['mysql.host'] = $config['mysql'][0];
				$config['mysql.db'] = $config['mysql'][3];
				$config['mysql.user'] = $config['mysql'][1];
				$config['mysql.password'] = $config['mysql'][2];
			}

			if(isset($config['allow']) && $config['allow'] == 'read') $config['allowread'] = 1;
		}
		else
		{
			if(!defined('MTTPATH')) define('MTTPATH', dirname(__FILE__) .'/');
			Config::loadConfig($config);
			unset($config); 

			$db = 0;
			$dbtype = '';
		}
		if(!$ver)
		{
			if(isset($_POST['installdb']))
			{

				$dbtype = ($_POST['installdb'] == 'mysql');

				if($dbtype == 'mysql') {
					Config::set('mysql.host', _post('mysql_host'));
					Config::set('mysql.db', _post('mysql_db'));
					Config::set('mysql.user', _post('mysql_user'));
					Config::set('mysql.password', _post('mysql_password'));
				}

				if(!is_writable('config.php')) {
					echo("Config file ('config.php') is not writable.");
				}
				Config::save();
				
			}
		}
		return [
		'template'=>'setup.php'
		];
	}

	function Create(){

		global $app;

		$res = $app->conn->query("
			CREATE DATABASE IF NOT EXISTS `todo`;
			USE `todo`;
			CREATE TABLE IF NOT EXISTS `todoasd` (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`title` text,
			`description` text,
			`date` datetime DEFAULT NULL,
			`state` float DEFAULT '0',
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;");

		if ($res) {Router::redirect('home');}else{Router::redirect('home');}
		
	}
}

class Config
{
	public static $params = array(
		'db' => array('default'=>'mysql', 'type'=>'s'),
		'mysql.host' => array('default'=>'localhost', 'type'=>'s'),
		'mysql.db' => array('default'=>'todo', 'type'=>'s'),
		'mysql.user' => array('default'=>'root', 'type'=>'s'),
		'mysql.password' => array('default'=>'', 'type'=>'s'),
		);

	public static $config;

	public static function loadConfig($config)
	{
		self::$config = $config;
	}

	public static function get($key)
	{
		if(isset(self::$config[$key])) return self::$config[$key];
		elseif(isset(self::$params[$key])) return self::$params[$key]['default'];
		else return null;
	}

	public static function set($key, $value)
	{
		self::$config[$key] = $value;
	}

	public static function save()
	{
		$s = '';
		foreach(self::$params as $param=>$v)
		{
			if(!isset(self::$config[$param])) $val = $v['default'];
			elseif(isset($v['options']) && !in_array(self::$config[$param], $v['options'])) $val = $v['default'];
			else $val = self::$config[$param];
			if($v['type']=='i') {
				$s .= "\$config['$param'] = ".(int)$val.";\n";
			}
			else {
				$s .= "\$config['$param'] = '".str_replace(array("\\","'"),array("\\\\","\\'"),$val)."';\n";
			}
		}
		$f = fopen('config.php', 'w');
		if($f === false) throw new Exception("Error while saving config file");
		fwrite($f, "<?php\n\$config = array();\n$s?>");
		fclose($f);
	}


}

function _post($param,$defvalue = '')
{
	if(!isset($_POST[$param])) 	{
		return $defvalue;
	}
	else {
		return $_POST[$param];
	}
}

function _get($param,$defvalue = '')
{
	if(!isset($_GET[$param])) {
		return $defvalue;
	}
	else {
		return $_GET[$param];
	}
} 