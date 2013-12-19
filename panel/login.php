<?php
/*
** CONTEST PORTAL v2 
** Created By Andy Sturzu (sturzu.org)
** login.php - Login Handler
*/

//INCLUDES
require_once($_SERVER["DOCUMENT_ROOT"]."/functions/global.php");
session_start();
//GET POST DATA 
$username = $_POST['teamnumber'];
$password = $_POST['password'];
//echo $username . " " . $password;
//CONNNECT TO THE DATABASE
connectDB();

//PERFORM REGISTRATION
$username = mysql_real_escape_string($username);
$query = "SELECT password, salt
        FROM users
        WHERE team = '$username';";
$result = mysql_query($query);
if(mysql_num_rows($result) < 1) {
    die("<div class='alert alert-error'><strong>Login Failed!</strong> User does not exist!</div>");
}
$userData = mysql_fetch_array($result, MYSQL_ASSOC);
$hash = hash('sha256', $password);
$salt = $userData['salt'];
$hash = hash('sha256', $salt . $hash);
if($hash != $userData['password']) {
    die("<div class='alert alert-error'><strong>Login Failed!</strong> Incorrect Password!</div>");
}
else {
    $_SESSION['valid'] = 1;
    $_SESSION['userid'] = $username;
    echo '<meta http-equiv="refresh" content="0">';
}
?>