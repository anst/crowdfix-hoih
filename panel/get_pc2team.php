<?php
/*
** CONTEST PORTAL v2 
** Created By Jonathan Zong (jonathanzong.com)
** get_pc2team.php - Returns PC^2 Username & Password
*/
	$teamnum = str_pad(intval($_POST['num'],10), 3, "0", STR_PAD_LEFT);
	$handle = @fopen("teams.lst", "r");
	if ($handle) {
		while (($buffer = fgets($handle)) !== false) {
			//echo $buffer;
			if(!strncmp($buffer, "1	team".$teamnum, 9)){
				$dat = explode("/\s+/", $buffer);
				if(count($dat) != 6) //DEBUG PURPOSES
					echo "Something went wrong...";
				echo "Your team username is ".$dat[1];
				echo "<br/>";
				echo "Your password is ".$dat[4];	
				break;
			}
		}
		if (!feof($handle)) {
			echo "Error: possibly expected fgets() fail\n";
		}
		fclose($handle);
	}
?>