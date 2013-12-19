<?php
if(isset($_POST['postid']) && $_POST['postid']){
/*
** 
** 
*/
require_once dirname(__FILE__).'/app/lib/mysql.php';
require_once dirname(__FILE__).'/app/config/config.php';
require_once dirname(__FILE__).'/app/frameworks/app.php';
require_once dirname(__FILE__).'/app/functions/functions.php';

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
        header("Refresh: 0; URL=/");
}
?>