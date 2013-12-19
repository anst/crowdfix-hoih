<?php
/*
** CONTEST PORTAL v2 
** Created By Andy Sturzu (sturzu.org)
** send_appeal.php - Appeal Sender
*/

//INCLUDES
require_once($_SERVER["DOCUMENT_ROOT"]."/functions/global.php");

//START SESSION
session_start();
//GET POST DATA
$team = $_SESSION['userid'];
$problem_number = mysql_real_escape_string($_POST['number']);
$message = mysql_real_escape_string($_POST['message']);
$pending = "Yes";

//CONNECT TO DATABASE
connectDB();

//SEND APPEAL
if($problem_number!=0) {
	$query = "INSERT into appeals VALUES ('','".$team."', '".$problem_number."', '".$pending."', '".$message."', '')";
	mysql_query($query) or die(mysql_error());
	header("Location: /");
} else {
	die("Silly rabbit, Trix are for kids.");
}



?>