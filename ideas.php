<?php
require_once dirname(__FILE__).'/app/lib/mysql.php';
require_once dirname(__FILE__).'/app/config/config.php';
require_once dirname(__FILE__).'/app/frameworks/app.php';
require_once dirname(__FILE__).'/app/functions/functions.php';

if(isset($_POST['content']) && $_POST['content']){
$content = mysql_real_escape_string($_POST['content']);
        $sql = "INSERT INTO `comments` (`userid`, `content`, `category`) VALUES ('".mysql_real_escape_string($_SESSION['userid'])."',$content,'".mysql_real_escape_string($_POST['category'])."');";
        mysql_query($sql) or die(mysql_error());
}
else if(isset($_GET['id']) && $_GET['id']){
	$postid = mysql_real_escape_string($_GET['id']);
	$q = mysql_query("SELECT * FROM `ideas` WHERE id=$postid") or die(mysql_error());
	while($info = mysql_fetch_assoc($q)){
		if($info['userid']){
            $sql = "SELECT * FROM `google_users` WHERE userid='{$info['userid']}'";
            $userq = mysql_query($sql) or die(mysql_error());
            $user = mysql_fetch_assoc($userq);                      
            $datetime = new DateTime($info['date']);
            echo "<div class='idea'>";
            echo "<div><strong>".$user['name']."</strong> - <span class='small'>".$datetime->format('F j, Y \a\t g:ia')." Up: ".$info['up']." Down: ".$info['down']."</span></div>";
            echo "<div>".$info['content']."</div>";
            echo '</div>';
            echo '<div style="clear:both;"><br></div>';
        }
	}
}
else if(isset($_GET['category']) && $_GET['category']){
	$cat = mysql_real_escape_string($_GET['category']);
	$sql = "SELECT userid, content, date, up, down, category, (up-down) AS total, ((CASE WHEN up = 0 THEN 0.1 ELSE up END) - down) AS totalOrder FROM `ideas` WHERE category='$cat' ORDER BY totalOrder DESC LIMIT 0,5";// PAGINATION >:(
$data = mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($data) == 0)
    echo "No posts. :(";
else{
    while($info = mysql_fetch_assoc($data)){
        if($info['userid']){
            $sql = "SELECT * FROM `google_users` WHERE userid='{$info['userid']}'";
            $userq = mysql_query($sql) or die(mysql_error());
            $user = mysql_fetch_assoc($userq);                      
            $datetime = new DateTime($info['date']);
            echo "<div class='idea'>";
            echo "<div><strong>".$user['name']."</strong> - <span class='small'>".$datetime->format('F j, Y \a\t g:ia')." Up: ".$info['up']." Down: ".$info['down']."</span></div>";
            echo "<div>".$info['content']."</div>";
            echo '</div>';
            echo '<div style="clear:both;"><br></div>';
        }
    }
}
else{
$sql = "SELECT userid, content, date, up, down, category, (up-down) AS total, ((CASE WHEN up = 0 THEN 0.1 ELSE up END) - down) AS totalOrder FROM `ideas` ORDER BY totalOrder DESC LIMIT 0,5";//FIX LIMIT
$data = mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($data) == 0)
    echo "No posts. :(";
else{
    while($info = mysql_fetch_assoc($data)){
        if($info['userid']){
            $sql = "SELECT * FROM `google_users` WHERE userid='{$info['userid']}'";
            $userq = mysql_query($sql) or die(mysql_error());
            $user = mysql_fetch_assoc($userq);                      
            $datetime = new DateTime($info['date']);
            echo "<div class='idea'>";
            echo "<div><strong>".$user['name']."</strong> - <span class='small'>".$datetime->format('F j, Y \a\t g:ia')." Up: ".$info['up']." Down: ".$info['down']."</span></div>";
            echo "<div>".$info['content']."</div>";
            echo '</div>';
            echo '<div style="clear:both;"><br></div>';
        }
    }
}
}
/*else {
        header("Refresh: 0; URL=/");
}*/
?>