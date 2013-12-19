<?php
/*
** CONTEST PORTAL v2 
** Created By Andy Sturzu (sturzu.org)
** view_response.php - Response Printer
*/

//INCLUDES
require_once($_SERVER["DOCUMENT_ROOT"]."/functions/global.php");

//START SESSION
session_start();
//GET POST DATA
$team = $_SESSION['userid'];
$number = mysql_real_escape_string($_GET['id']);

//CONNECT TO DATABASE
connectDB();

//SEND APPEAL
$query = "SELECT id, team, message, reply
        FROM appeals
        WHERE team = '$team';";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)) {
	if($row['id']==$number&&$row['team']==$team) {
			echo "<div class=\"well input-block-level\">";
			echo "<h4>Team #".$team." says:</h4>";
			echo "<span>".$row['message']."</span>";
			echo "</div>";
		if($row['reply']=="") {
			echo "<div class=\"well input-block-level\">";
			echo "<h4>Judge says: </h4>";
			echo 'No response, yet.';
			echo "</div>";
		}
		else { 
			echo "<div class=\"well input-block-level\">";
			echo "<h4>Judge says: </h4>";
			echo "<span>".$row['reply']."</span>";
			echo "</div>";
		}
	}
}
if($row = mysql_fetch_array($result)&&mysql_num_rows($row)==0) {
	echo "<center>No appeals.</center>";
}
echo "</table>";
//$query = "INSERT into appeals VALUES ('','".$team."', '".$problem_number."', '".$pending."', '".$message."', '')";
//mysql_query($query) or die(mysql_error());


?>