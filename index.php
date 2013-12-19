<?php
/*
** 
** 
*/
require_once dirname(__FILE__).'/app/lib/mysql.php';
//require_once dirname(__FILE__).'/app/config/config.php';
require_once dirname(__FILE__).'/app/frameworks/app.php';
require_once dirname(__FILE__).'/app/functions/functions.php';

$app = new App('app',false, 'logs/' . date('Y-m-d') . '.txt'); //include default routing engine with logs enabled

$app->route('/crowdfix/', function($app) { //index router, check for login
	if(!isLoggedIn()) return $app->render("index.html",array(
		"title"=>title,
		"loggedin"=>"false",
	));
	return $app->render("index.html",array(
		"title"=>title,
		"loggedin"=>"true",
	));
});
$app->route('/crowdfix/ideas/', function($app) {
	if(!isLoggedIn()) return $app->render("homeposts.html",array(
		"title"=>title,
		"loggedin"=>"false",
	));
	return $app->render("homeposts.html",array(
		"title"=>title,
		"loggedin"=>"true",
	));
});
$app->route('/crowdfix/ideas/<string>', function($app, $name) {
	if(!isLoggedIn()) return $app->render("posts.html",array(
		"title"=>title,
		"loggedin"=>"false",
		"postslug"=>$name,
	));
	return $app->render("posts.html",array(
		"title"=>title,
		"loggedin"=>"true",
		"postslug"=>$name,
	));
});
$app->route('/crowdfix/about', function($app) {
	if(!isLoggedIn()) return $app->render("about.html",array(
		"title"=>title,
		"loggedin"=>"false",
	));
	return $app->render("about.html",array(
		"title"=>title,
		"loggedin"=>"true",
	));
});
$app->route('/crowdfix/comments', function($app) {
	if(isset($_POST['postid']) && $_POST['postid']){
	$postid = mysql_real_escape_string($_POST['postid']);
	if(isset($_POST['content']) && $_POST['content']){
	        $sql = "INSERT INTO `comments` (`userid`, `postid`, `content`) VALUES ('".mysql_real_escape_string($_POST['userid'])."',$postid,'".mysql_real_escape_string($_POST['content'])."');";
	        mysql_query($sql) or die(mysql_error());
	}
	$sql = "SELECT * FROM `comments` WHERE postid=$postid";
	$data = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($data) == 0)
	    echo "No comments.";
	else{
	    while($info = mysql_fetch_assoc($data)){
	        if($info['userid']){
	            $sql = "SELECT * FROM `google_users` WHERE userid='{$info['userid']}'";
	            $userq = mysql_query($sql) or die(mysql_error());
	            $user = mysql_fetch_assoc($userq);                      
	            $datetime = new DateTime($info['date']);
	            echo "<div class='comment'>";
	            echo "<div><strong>".$user['name']."</strong> - <span class='small'>".$datetime->format('F j, Y \a\t g:ia')."</span></div>";
	            echo "<div>".$info['content']."</div>";
	            echo '</div>';
	            echo '<div style="clear:both;"><br></div>';
	        }
	    }
	}
	}
	else {
	        header("Refresh: 0; URL=/crowdfix");
	}
});
$app->route('/crowdfix/api', function($app) {
	$id = $_POST['id'];
	$sql = "SELECT * FROM ideas WHERE id = $id";
	$query = mysql_query($sql);
	while($row = mysql_fetch_assoc($query)){
	    echo "$row[userid]<br>
	    $row[content]<br>
	    Posted: $row[date]<br>
	    Up: $row[up] Down: $row[down]<br>
	    Category: $row[category]<br>";
	    echo "<a href='#' id='up'>Up</a> 
	    <a href='#' id='down'>Down</a>";
	}
	echo "<h1>Comments</h1>";
	$sql = "SELECT * FROM comments WHERE postid = $id";
	$query = mysql_query($sql);
	while($row = mysql_fetch_assoc($query)){
	    echo "$row[userid] $row[date] $row[content] <br>";
	}
});




$app->run();
?>