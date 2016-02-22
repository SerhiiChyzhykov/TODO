<?php 
date_default_timezone_set("Europe/Kiev");
include 'boot.php';
$app = new App;
$app->dispatch();
$app->go();
$app->render();