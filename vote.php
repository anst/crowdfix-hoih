<?php
if(isset($_GET['id']) && $_GET['id'] && isset($_GET['mode'])){
/*
** 
** 
*/
require_once dirname(__FILE__).'/app/lib/mysql.php';
require_once dirname(__FILE__).'/app/config/config.php';
require_once dirname(__FILE__).'/app/frameworks/app.php';
require_once dirname(__FILE__).'/app/functions/functions.php';

$app->route('/', function($app) { //index router, check for login
	if(!isLoggedIn()) return $app->render("login.html",[
		"title"=>title,
	]);
	return $app->render("home.html",[
		"title"=>title,
	]);
});

$postid = mysql_real_escape_string($_GET['id']);
if($mode)
	$q="UPDATE ideas SET up = up + 1 WHERE id=$postid";
else $q="UPDATE ideas SET down = down + 1 WHERE id=$postid";
}
?>