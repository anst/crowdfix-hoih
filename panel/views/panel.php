<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/functions/global.php");
connectDB();
if (isset($_GET["update"]) && $_GET["update"] == "true"&&canUpdateTeam()) {
	$result = mysql_query("SELECT * FROM users WHERE team='" . $_SESSION["userid"] . "'") or die(mysql_error());
	$row = mysql_fetch_array($result);
	$member2 = $row['member2'];
	$member3 = $row['member3'];	
	if(isset($_POST['member2']) && $_POST['member2'])
		$member2 = $_POST['member2'];
	if(isset($_POST['member3']) && $_POST['member3'])
		$member3 = $_POST['member3'];	
	if($member3 && !$member2 && $member3 != $row['member3']){
		$member2 = $member3;
		$member3 = "";
	}
	if ($member2 && $member2 != $row['member2']) {
		mysql_query("UPDATE users SET member2='" . $member2 . "' WHERE team='" . $row['team'] . "'") or die(mysql_error());
	}
	if ($member3 && $member3 != $row['member3']) {
		mysql_query("UPDATE users SET member3='" . $member3 . "' WHERE team='" . $row['team'] . "'") or die(mysql_error());
	}
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/">';
} else if(isset($_GET["update"])) {	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/">'; }
if (isset($_GET["order"]) && $_GET["order"]&&canOrderPizza()) {
	$team = $_SESSION['userid'];
	if(isset($_POST['pepperoni']) && $_POST['pepperoni'])
		$pepperoni = mysql_real_escape_string($_POST['pepperoni']);
	else $pepperoni = 0;
	if(isset($_POST['sausage']) && $_POST['sausage'])
		$sausage = mysql_real_escape_string($_POST['sausage']);
	else $sausage = 0;
	if(isset($_POST['cheese']) && $_POST['cheese'])
		$cheese = mysql_real_escape_string($_POST['cheese']);
	else $cheese = 0;	
	$total = ((int)$pepperoni + (int)$sausage + (int)$cheese)*10;
	$query = "INSERT into pizza (team,pepperoni,sausage,cheese,total) VALUES ($team,$pepperoni,$sausage,$cheese,$total)";
	mysql_query($query) or die(mysql_error());
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/">';
}
$tpl = new raintpl(); //Create a new TPL object
$tpl->assign("school", SCHOOLNAME); //Assign Variable Names to the template
$tpl->assign("contest", CONTESTNAME . " | Team Panel"); //Assign Variable Names to the template
$tpl->assign("logo", LOGOPATH); //Assign Variable Names to the template
$tpl->assign("theme", theme); //Assign Variable Names to the template
$tpl->assign("color", login_background_color); //Assign Variable Names to the template
$tpl->assign("type", "panel"); //Assign Variable Names to the template
$tpl->draw("header_panel"); //Draw the header html
//BEGIN PANEL HTML CONTENT
?>
<div class="modal fade" id="view_response">
 <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Appeal:</h3>
  </div>
    <div class="modal-body">
        <p></p>
    </div>
</div>
<div class="navbar navbar-fixed-top" style="">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="#"><?php
echo CONTESTNAME;
?></a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
        	<span id="team_number" style="display: none;"><?php echo $_SESSION['userid'];?></span>
        	<li><a href="/logout.php">Log Out</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container"><br>
	<div class="alert alert-info">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <h4>Welcome!</h4>
	  Thanks for registering for the contest. Here you can view the rankings on the scoreboard, order pizza, create appeals, and edit your team members information.
	</div>
	<?php
		if (!contestHasStarted()) {
		echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>Contest Not Started</h4>
			You can still order pizza and modify your team members, do it before time runs out!
		</div>';
		} else {
		echo '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>Contest Started</h4>
			Pizza orders have been disabled. You can submit appeals at the end of the contest.
		</div>';
		}
	?>
	 <div class="row">
<div class="span6">
			<div class="well">
				<h3>Contest Resources:</h3>
				<ul>
					<?php
						if(!contestHasStarted()) {
							echo '
							<li><a href="/getfile.php?file=sample_problem">Sample Problem</a></li>
							<li><a href="/getfile.php?file=sample_data">Sample Data</a></li>
							<li><a href="#solution">Sample Solution</a></li>
							<li><a href="/getfile.php?file=pc2client">
								PC<sup>2</sup> client</a>
								<ul>
									<li><b>Your Username is: </b>lul</li>
									<li><b>Your Password is: </b>lelelle</li>
								</ul>
							</li>
								';
						} else {
							echo '<li><a href="/getfile.php?file=real_data">Hands-On Data</a></li>
								  <li><a href="/getfile.php?file=sample_problem">Sample Problem</a></li>
								  <li><a href="/getfile.php?file=pc2client">PC<sup>2</sup> client</a>
										<ul>
											<li><b>Your Username is: </b>lul</li>
											<li><b>Your Password is: </b>lelelle</li>
										</ul>
									</li>
								   ';
						}
					?>
				</ul>
			</div>
		</div>
	  <div class="span6">
		<div class="well">
			<h3>Edit Team:</h2>
				<?php 	$result = mysql_query("SELECT * FROM users WHERE team='" . $_SESSION["userid"] . "'") or die(mysql_error()); $row = mysql_fetch_array($result);?>
        <center>
        <?php if(!canUpdateTeam()) echo '<div class="alert">
  <button type="button" class="close" data-dismiss="alert">×</button>
Teams cannot be edited anymore.
</div>';?>
        <form method="post" action="/?update=true">
        <table class="table table-striped table-bordered " style="text-align: right;">
		  <tr>
		    <td>Team Number:</td>
		    <td><input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="<?php echo $row['team'];?>" disabled=""></td>
		  </tr>
		  <tr>
		    <td>School:</td>
		    <td><input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="<?php echo $row['school'];?>" disabled=""></td>
		  </tr>
		  <tr>
		    <td>Team Member #1:</td>
		    <td><input class="input-xlarge disabled" id="disabledInput" type="text" name="member1" placeholder="<?php echo $row['member1'];?>" disabled=""</td>
		  </tr>
		  <tr>
		    <td>Team Member #2:</td>
		    <td><?php
				if (isset($row['member2']) && $row['member2'] != "") {
					echo '<input class="input-xlarge disabled" id="disabledInput" name="member2disabled" disabled="" type="text" placeholder="' . $row['member2'] . '">';
				} else
					echo '<input class="input-xlarge" name="member2" type="text" value="' . $row["member2"] . '">';
			?></td>
		  </tr>
		  <tr>
		    <td>Team Member #3:</td>
		    <td><?php
					if (isset($row['member3']) && $row['member3'] != "") {
						echo '<input class="input-xlarge disabled" id="disabledInput" name="member3disabled" disabled="" type="text" placeholder="' . $row['member3'] . '">';
					} else
						echo '<input class="input-xlarge" name="member3" type="text" value="' . $row["member3"] . '">';
				?></td>
		  </tr>
		  <tr>
		    <td></td>
		    <td><input type="submit" class="btn btn-inverse" href="#" value="Submit Changes"></td>
		  </tr>
			</table>
			</form>
        </center>
		</div>
	  </div>
	</div>
	<div class="row">
	  <div class="span6">
		<div class="well">
			<h3>Submit Appeal:</h2>
			<?php
				if(canSubmitAppeal()) {
					echo '<form method="post" action="/send_appeal.php">
							<select name="number" id="" class="span2">
								<option value="0">Problem Number</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
							</select><br>
							<textarea name="message" id="message" cols="50" rows="10" class="input-block-level" placeholder="Enter your appeal here."></textarea><br>
							<input class="btn btn-inverse" type="submit" value="Send Appeal">
						</form>';
				}
				else { 
					echo '
						<form method="post">
							<select name="number" id="" class="span2 disabled" disabled>
								<option value="">Problem Number</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
							</select><br>
							<textarea name="message" id="message" cols="50" rows="10" placeholder="Enter your appeal here." class="disabled input-block-level" disabled></textarea><br>
							<input class="btn btn-inverse disabled" type="submit" value="Send Appeal" disabled>
						</form>';
				}
			?>
		</div>
	  </div>
	  <div class="span6">
		<div class="well">
			<h3>View Appeals:</h3>
			<div id="appeals">
				<!-- Content will be loaded here dynamically with Ajax. -->
			</div>
		</div>
	  </div>
	</div>
	<div class="row">
	  <div class="span6">
		<div class="well">
				<h3>Pizza Order:</h2>
				<?php
					if(canOrderPizza()) {
						echo "You can only order your pizza once, so make your choice final! We will come around and collect the money for the pizza in a while. Please have your money ready when you are asked.<br><br>";
						echo '<div class="row"><div class="span2"><form id="pizzaform" action="/?order=true" method="POST">
							  <input class="span2" name="pepperoni" id="pepperoni" type="text" placeholder="Pepperoni Quantity"><br>
							  <input class="span2" name="sausage" id="sausage" type="text" placeholder="Sausage Quantity"><br>
							  <input class="span2" name="cheese" id="cheese" type="text" placeholder="Cheese Quantity"><br>
							  <input class="btn btn-inverse" type="submit" value="Order"></div><div class="span3"><span style="color: #66cc00; font-size: 36px; font-weight: 100;margin-right:2px;" id="dollabillsyall">Total: $</span><span style="color: #66cc00; font-size: 36px; font-weight: 400;" id="total">0</span></div></div>
							</form>';
					} else {
						echo "You cannot make pizza orders at this time. If you have ordered your pizza, then please have your money ready when you are told.<br><br>";
						echo '<form action="">
							  <input class="span2 disabled"  id="pepperoni" type="text" placeholder="Pepperoni Quantity" disabled><br>
							  <input class="span2 disabled" id="pepperoni" type="text" placeholder="Sausage Quantity" disabled><br>
							  <input class="span2 disabled" id="pepperoni" type="text" placeholder="Cheese Quantity" disabled><br>
							  <input class="btn btn-inverse disabled" type="submit" value="Order" disabled>
							</form>';
					}
				?>
			</div>
		</div>
			  <div class="span6">
		<div class="well" id="solution">
			<h3>Sample Problem Solution:</h2>
			<pre class="pre-scrollable">
import java.util.*;
public class sample {
	public static void main(String[] args) {
		Scanner sc = new Scanner(new File("sample.in"));
		int ds = sc.nextInt();
		for(int x = 0; x < ds; x++) {
			int a = sc.nextInt();
			int b = sc.nextInt();
			System.out.println(a+b+15);
		}
	}
}
			</pre>
		</div>
	  </div>
	</div>
    <div class="row">
	  <div class="span12">
		<div class="well">
			<center><h3>Scoreboard:</h3></center>
			<?php
			if(canSeeScoreboard()) include("temp_scoreboard.html");
			else echo "<center><h4>The scoreboard cannot be viewed at this time.</h4></center>";
			?>
		</div>
	  </div>
	</div>
	<div class="row">
		<div class="span12">
			<center style="line-height: 20px;">Created by Andy Sturzu.</center>
		</div>
	</div>
</div> 
<?php
$tpl->draw("footer"); //Draw the footer body html
?>
