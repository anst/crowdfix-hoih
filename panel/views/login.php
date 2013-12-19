<?php
/*
** CONTEST PORTAL v2 
** Created By Andy Sturzu (sturzu.org) 
** views/login.php - Load Login Templates
*/
require_once($_SERVER["DOCUMENT_ROOT"]."/functions/global.php");

$tpl = new raintpl(); //Create a new TPL object
$tpl->assign( "school", SCHOOLNAME ); //Assign Variable Names to the template
$tpl->assign( "contest", CONTESTNAME ); //Assign Variable Names to the template
$tpl->assign( "logo", LOGOPATH ); //Assign Variable Names to the template
$tpl->assign( "theme", theme); //Assign Variable Names to the template
$tpl->assign( "color", login_background_color); //Assign Variable Names to the template
$tpl->assign( "type", "login" ); //Assign Variable Names to the template
$tpl->draw( "header" ); //Draw the header html
$tpl->draw( "login" ); //Draw the main body html
$tpl->draw( "footer" ); //Draw the footer body html

?>