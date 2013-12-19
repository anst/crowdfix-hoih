<?php
/*
** CONTEST PORTAL v2 
** Created By Andy Sturzu (sturzu.org)
** register.php - Register Handler
*/

//INCLUDES
require_once($_SERVER["DOCUMENT_ROOT"]."/functions/global.php");

//GET POST DATA AND STERILIZE IT
$division = mysql_real_escape_string($_POST['novadv']);
$school = mysql_real_escape_string($_POST['school']);
$teamnumber = mysql_real_escape_string($_POST['teamnumber']);
$password = mysql_real_escape_string($_POST['password']);
$member1 = mysql_real_escape_string($_POST['member1']);
$member2 = mysql_real_escape_string($_POST['member2']);
$member3 = mysql_real_escape_string($_POST['member3']);
if($member3 != ""&& $member2 == "") {
	//die("<div class='alert alert-error'><strong>Registration Failed!</strong> Please enter your first & second member.</div>");
	$member2 = $member3;
	$member3 = "";
}
//CHECK DIVISION
if($division == "adv") {
	$division = "Advanced";
} else {
	$division = "Novice";
}

//ENCRYPT PASSWORD WITH SHA256 AND A SALT
$hash = hash('sha256', $password);
$salt = createSalt();
$hash = hash('sha256', $salt . $hash);

//CONNNECT TO THE DATABASE
connectDB();

//PERFORM CHECK WETHER THE TEAM NUMBER EXISTS OR NOT
if (mysql_num_rows(mysql_query("SELECT * from users WHERE team='" . $teamnumber . "'")) > 0) { //SEND ERROR THROUGH AJAX
	echo "<div class='alert alert-error'><strong>Registration Failed!</strong> Username already exists! Please try again.</div>";
} else { //START REGISTRATION PROCESS
	$query = "INSERT into users VALUES ('".$teamnumber."','".$division."', '".$hash."', '".$salt."', '".$member1."', '".$member2."', '".$member3."', '".$school."')";
	mysql_query($query) or die(mysql_error());
		echo "<div class='alert alert-success'><strong>Congrats!</strong> You have successfuly registered, please <a href='' data-dismiss='modal' id='moveOn'>login</a>.</div>";
}

?>