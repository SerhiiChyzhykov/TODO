<?php 

class Router{
	public $parts;

	public function __construct($url){
		preg_match_all('#/([\w._-]*)#', $url, $matches);
		$this->parts = $matches[1];
	}

	public static function redirect($url){
		header("Location: {$url}");
		exit();
	}

	public function getAction(){
		switch ($this->parts[0]){
		case '':
			return ['Home', 'home'];
			break;
		case 'home':
			return ['Home', 'home'];
		case 'add':
			return ['Home', 'Add'];
			break;
		case 'edit':
			return ['Home', 'Edit'];
			break;
		case 'delete':
			return ['Home', 'Delete'];
			break;
		case 'complete':
			return ['Home', 'complete'];
			break;
		case 'delete_':
			return ['Home', 'delete_'];
			break;
		case 'save':
			return ['Home', 'save'];
			break;
		case 'setup':
			return ['Setup', 'Setup'];
			break;
		case 'create':
			return ['Setup', 'Create'];
			break;
		case '404':
			return ['Error', 'PageNotFound'];
			break;
			default:Router::redirect('404');
			break;
		}
	}
}