<?php
	function createSalt() {
	    $string = md5(uniqid(rand(), true));
	    return substr($string, 0, 3);
	}
	sleep(2);
	// Create arry that we can return using json
	$data = array();
	
	// Default response is false
	// Please do not remove
	$data['response'] = false;
	$data['step'] = false;
	
	
	if($_GET['step'] == 2){
		
		if(isset($_POST['dbname']) && isset($_POST['dbuser']) && isset($_POST['dbpass']) && isset($_POST['dbhost'])){
		
			if($link = mysql_connect($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpass'], $_POST['dbname'])){ $slink = true;  }else{ $slink = false; }
			
			if(!$slink){ 
				$data['message'] = 'Error establishing a database connection';
			}else{
				/*define('DB_SERVER', $_POST['dbhost']); 
				define('DB_USER', $_POST['dbuser']);
				define('DB_PASSWORD', $_POST['dbpass']);
				define('DB_NAME', $_POST['dbname']);
				$data['response'] = true;*/
			}	
		}
	}
	
	if($_GET['step'] == 3){
		$link = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die($data['message'] = mysql_error());
		$query = "INSERT into system VALUES ('".$_POST['contestname']."','".$_POST['schoolname']."', 'views/img/logo.png', 'false', 'default', 'eeeeee')";
		mysql_query($query) or die(mysql_error());
		$password = $_POST['password'];
		$hash = hash('sha256', $password);
		$salt = createSalt();
		$hash = hash('sha256', $salt . $hash);
		$query = "INSERT into admin VALUES ('".$_POST['username']."','".$hash."', '".$salt."')";
		mysql_query($query) or die(mysql_error());
	}
	if($_GET['step'] == 4){
		$data['response'] = true;
	}
	echo json_encode($data);
?>