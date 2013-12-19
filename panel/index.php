<?php
/*
** CONTEST PORTAL v2 
** Created By Andy Sturzu (sturzu.org)
** index.php - Load the Specific Page
*/

//INCLUDES
require_once($_SERVER["DOCUMENT_ROOT"]."/functions/global.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/functions/rain.tpl.class.php");

raintpl::$tpl_dir = "views/"; //VIEW DIRECTORY
raintpl::$cache_dir = "cache/"; //CACHE DIRECTORY
//CHECK FOR LOGIN
session_start();
if (isset($_SESSION['valid']) && $_SESSION['valid']) {
	include_once($_SERVER["DOCUMENT_ROOT"]."/views/panel.php"); //LOAD THE PANEL
} else {
	include_once($_SERVER["DOCUMENT_ROOT"]."/views/login.php"); //LOAD THE LOGIN/REGISTER SCREEN
}

?>