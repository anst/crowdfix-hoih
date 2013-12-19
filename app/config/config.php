<?php
/*
** 
** 
*/

//---------- APP INFO ------------------//	
$APP_NAME = "CrowdFix";        
$APP_VERSION = "0.01";                  
$APP_AUTHOR = "Team Taylor";            

//---------- DATABASE CONFIG ------------------//	
define('host', 'localhost');
define('db', 'jonath11_crowdfix');
define('user', 'jonath11');
define('pw', '');

//---------- CONTEST CONFIG ------------------//
define('title', "*-------------CrowdFix - Open Innovation Houston");

mysql_connect(host, user, pw, db);
mysql_select_db('crowdfix');
?>