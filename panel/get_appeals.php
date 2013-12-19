<?php
/*
** CONTEST PORTAL v2 
** Created By Andy Sturzu (sturzu.org)
** get_appeals.php - Appeal Printer
*/

//INCLUDES
require_once($_SERVER["DOCUMENT_ROOT"]."/functions/global.php");

//START SESSION
session_start();
//GET POST DATA
$team = $_SESSION['userid'];
$number = mysql_real_escape_string($_GET['team']);
if($team != $number) {
	die("What are you trying to do?");
}

//CONNECT TO DATABASE
connectDB();

//SEND APPEAL
$query = "SELECT id, problem, pending, message, reply
        FROM appeals
        WHERE team = '$team';";
$result = mysql_query($query) or die("No appeals.");
echo "<table class=\"table table-bordered table-striped \">";
echo '<tr style="font-weight: bold">
			<td class="span1">Ticket</td>
			<td class="span1">Problem</td>
			<td class="span1">Status</td>
			<td>Message</td>
			<td class="span1"></td>
		</tr>';
while($row = mysql_fetch_array($result)) {
	echo "<tr>";
	echo "<td>".$row['id']."</td>";
	echo "<td>".$row['problem']."</td>";
	if ($row['pending']=="Yes") {
		echo "<td><span class=\"label label-success\">New</span></td>";
	} else {
		echo "<td><span class=\"label label-important\">Replied</span></td>";
	}
	echo "<td>".substr($row['message'], 0,35)."...</td>";
	echo "<td><a id=\"click\" href=\"/view_response.php?id=".$row['id']."\" data-toggle=\"modal\" data-target=\"#view_response\">View</a>"."</td>";
	echo "</tr>";

}
echo "</table>";



?>