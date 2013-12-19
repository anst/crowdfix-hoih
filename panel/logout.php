<?php
/*
** CONTEST PORTAL v2 
** Created By Andy Sturzu (sturzu.org)
** logout.php - Logout Handler
*/

//INCLUDES + SESSION START
session_start();

//LOGOUT
$_SESSION = array(); //destroy all of the session variables
session_destroy();
header("Location: /");

?>