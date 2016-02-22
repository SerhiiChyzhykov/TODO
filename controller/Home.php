<?php 

class Home{

	public function Home(){
		global $app;

		$todo = $app->conn->query("SELECT * FROM todo WHERE state = 0 ORDER BY date DESC");
		$todo_edit = $app->conn->query("SELECT * FROM todo WHERE state = 0 ORDER BY date DESC");
		$todo_end= $app->conn->query("SELECT `state`, COUNT(`state`) AS count FROM `todo` GROUP BY state HAVING COUNT(count) > 0");
		$todo_end_m= $app->conn->query("SELECT `state`, COUNT(`state`) AS count FROM `todo` GROUP BY state HAVING COUNT(count) > 0");
		return [
		'template'=>'home.php',
		'todo' => $todo,
		'todo_end' =>$todo_end,
		'todo_end_m' =>$todo_end_m,
		'todo_edit'=>$todo_edit
		];
	}

	public function Edit(){
		global $app;
		
		$title =  $description =  $id =  Null;
		extract($_GET);
		$date =  date("Y-m-d\TH:i:sP"); 
		$state = 0;
		if (isset($title) && isset($description) ) {
			if(!empty($title) && !empty($description)){

				$stmt = $app->conn->prepare("UPDATE todo SET title = :title , description = :description , date = :d , state = :state WHERE id = :id");
				$stmt->bindParam (":title", $title, PDO::PARAM_STR);
				$stmt->bindParam (":description", $description, PDO::PARAM_STR);
				$stmt->bindParam (":id", $id, PDO::PARAM_INT);
				$stmt->bindParam (":d", $date, PDO::PARAM_STR);
				$stmt->bindParam (":state", $state, PDO::PARAM_STR);
				$stmt->execute();
			}
		}
		if ($res) {Router::redirect('home');}else{Router::redirect('home');}
	}

	public function Add(){
		global $app;

		$title =  $description =  Null;
		extract($_POST);
		$date =  date("Y-m-d\TH:i:sP"); 
		if (isset($title) && isset($description) ) {
			if(!empty($title) && !empty($description)){

				$stmt = $app->conn->prepare("INSERT INTO todo(title, description,date) VALUES(?,?,?)");
				$res = $stmt->execute([
					$title,
					$description,
					$date
					]);
			}
		}

		if ($res) {Router::redirect('home');}else{Router::redirect('home');}
	}

	public function Delete(){
		global $app;
		$id = Null;

		extract($_GET);

		$stmt = $app->conn->prepare('DELETE FROM todo WHERE id = :id ');
		$stmt->bindParam (":id", $id, PDO::PARAM_INT);
		$res = $stmt->execute();
		if ($res) {Router::redirect('home');}else{Router::redirect('home');}
	}

	public function Delete_(){
		global $app;

		$id = Null;
		extract($_GET);

		$stmt = $app->conn->prepare('DELETE FROM todo WHERE id = :id ');
		$stmt->bindParam (":id", $id, PDO::PARAM_INT);
		$res = $stmt->execute();
		if ($res) {Router::redirect('/complete');}else{Router::redirect('/complete');	}
	}

	public function Complete(){
		global $app;

		$todo = $app->conn->query("SELECT * FROM todo WHERE state = 1 ORDER BY date DESC");
		$todo_end= $app->conn->query("SELECT `state`, COUNT(`state`) AS count FROM `todo` GROUP BY state HAVING COUNT(count) > 0");
		$todo_end_m= $app->conn->query("SELECT `state`, COUNT(`state`) AS count FROM `todo` GROUP BY state HAVING COUNT(count) > 0");
		return [
		'todo' => $todo,
		'todo_end' =>$todo_end,
		'todo_end_m' =>$todo_end_m,
		'template'=>'complete.php'
		];
	}

	public function Save(){
		global $app;
		
		$id =  '';
		$state = 1;
		$date =  date("Y-m-d\TH:i:sP"); 
		extract($_GET);

		if (!empty($id)) {
			if (isset($id)) {
				foreach ($id as $key ) {

					$stmt = $app->conn->prepare("UPDATE todo SET state =:state , date = :d WHERE id = :id");
					$stmt->bindParam (":state", $state, PDO::PARAM_STR);
					$stmt->bindParam (":d", $date, PDO::PARAM_STR);
					$stmt->bindParam (":id", $key, PDO::PARAM_INT);
					$res = $stmt->execute(); 
				}
			}
		}else{Router::redirect('home');}
		if ($res) {Router::redirect('home');}
	}
}