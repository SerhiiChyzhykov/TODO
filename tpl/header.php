<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>Todo list</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="src/css/materialize.css"  media="screen,projection"/>
	<script src="src/js/jquery-2.1.1.min.js"></script>
	<script src="src/js/materialize.js"></script>
	<script src="src/js/init.js"></script>
</head>
<body class="todo">
<header class="todo-header">
	<nav>
		<div class="nav-wrapper">
			<a href="home" class="brand-logo center">Todo list</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<? foreach ($this->content['todo_end'] as  $i ): ?> 
				<?if ($i['state'] == 0):?> 
				<li><a href="/">Todo <span class="new badge"><?=$i['count'];?></span></a></li>
				<?else:?>
				<li><a href="/complete">Complete <span class="badge"><?=$i['count'];?> </span></a></li>
				<?endif;?>
				<?endforeach;?>
			</ul>
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<!-- navbar for mobile -->
			<ul class="side-nav" id="mobile-demo">
				<?foreach ($this->content['todo_end_m'] as  $i ): ?> 
				<?if ($i['state'] == 0):?> 
				<li><a href="/">Home <span class="new badge"><?=$i['count'];?></span></a></li>
				<?else:?>
				<li><a href="/complete">Complete <span class="badge"><?=$i['count'];?> </span></a></li>
				<?endif;?>
				<?endforeach;?>
			</ul>
		</div>
	</nav>
</header>
<br/>