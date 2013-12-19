<?php
/*
** CONTEST PORTAL v2 
** Created By Andy Sturzu (sturzu.org)
** functions/global.php - Various Functions/Config
*/

//*CONFIG*///////////////////////////////////////////////////////////////////////

//DATABASE CONFIGURATION
define('DB_SERVER', 'localhost'); 
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'thsv2');

//GENERAL INFORMATION
define('SCHOOLNAME', "Taylor High School"); //Name of the School Hosting the Contest
define('CONTESTNAME', "Taylor High School Contest"); //Name of the Contest - Maximum 40 Characters
define('LOGOPATH', "views/img/logo.png"); //Logo to be shown in the login screen

//SCRIPT CONFIGURATION
define('MEMCACHED', false); //True: Use memcached, False: Don't use memcached

//DESIGN CONFIGURATION
define('theme', 'default'); 
define('login_background_color', 'eeeeee'); //NOT RECOMMENDED TO CHANGE
define('pizzaprice', '10'); 

//ADVANCED INFORMATION -- DO NOT MODIFY UNLESS YOU KNOW WHAT YOU'RE DOING!
$root = pathinfo($_SERVER['SCRIPT_FILENAME']);
define ('BASE_FOLDER', basename($root['dirname']));
define ('SITE_ROOT',    realpath(dirname(__FILE__)));
define ('SITE_URL',    'http://'.$_SERVER['HTTP_HOST'].'/');


//*FUNCTIONS*/////////////////////////////////////////////////////////////////////

//REGISTRATION/LOGIN FUNCTIONS
function isLoggedIn() {
    if(isset($_SESSION['valid']) && $_SESSION['valid'])
        return true;
    return false;
}
function logout() {
	$_SESSION = array(); //destroy all of the session variables
    session_destroy();
    header("Location: /");
}
function createSalt() {
    $string = md5(uniqid(rand(), true));
    return substr($string, 0, 3);
}
function validateUser()
{
    session_regenerate_id (); //this is a security measure
    $_SESSION['valid'] = 1;
    $_SESSION['userid'] = $userid;
}
function connectDB() {
	$link = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME); 
	if (!$link) { 
	    die('Could not connect: ' . mysql_error()); 
	} 
	mysql_select_db("thsv2"); 
}
function performQuery($query) {
	mysql_query($query) or die(mysql_error);
}
function returnQuery($query) {
	return mysql_query($query) or die(mysql_error);
}
//GENERAL FUNCTIONS
function redirect($page) {
	header('Location' . $page);
	exit();
}
function contestHasStarted() {
	connectDB();
	$query = mysql_query("SELECT contest FROM system") or die(mysql_error());
	$result = mysql_fetch_array($query, MYSQL_ASSOC);
	if($result['contest']=="On") {
		return true;
	} else {
		return false;
	}
}
function contestHasEnded() {
	connectDB();
	$query = mysql_query("SELECT ended FROM system") or die(mysql_error());
	$result = mysql_fetch_array($query, MYSQL_ASSOC);
	if($result['ended']=="Yes") {
		return true;
	} else {
		return false;
	}
}
function canSeeScoreboard() {
	connectDB();
	$query = mysql_query("SELECT scoreboard FROM system") or die(mysql_error());
	$result = mysql_fetch_array($query, MYSQL_ASSOC);
	if($result['scoreboard']=="On") {
		return true;
	} else {
		return false;
	}
}
function canOrderPizza() {
	connectDB();
	$team = intval($_SESSION['userid']);
	$query =  mysql_query("SELECT * FROM pizza WHERE team=$team")or die(mysql_error());
	$result = mysql_fetch_array($query, MYSQL_ASSOC);
	if(isset($result['team'])||contestHasStarted()) {
		return false;
	} else {
		if(contestHasEnded()){ return false;}
		else{ return true;} 
	}
}
function canSubmitAppeal() {
	if(!contestHasStarted()&&contestHasEnded()) {
		return true;
	} else {
		return false;
	}
}
function canUpdateTeam() {
	if(!contestHasStarted()&&!contestHasEnded()) {
		return true;
	} else {
		return false;
	}
}

//ADVANCED FUNCTIONS -- DO NOT MODIFY UNLESS YOU KNOW WHAT YOU'RE DOING!



?>