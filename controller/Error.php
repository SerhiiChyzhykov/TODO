<?php
/**
* 404
*/
class Error
{
	public function PageNotFound()
	{
		global $app;
		$todo_end= $app->conn->query("SELECT COUNT(*) FROM todo WHERE state = 1");
		$todo_start= $app->conn->query("SELECT COUNT(*) FROM todo WHERE state = 0");
		return [
		'template'=>'404.php',
		'todo_end' =>$todo_end,
		'todo_start' =>$todo_start
		];
	}
}

