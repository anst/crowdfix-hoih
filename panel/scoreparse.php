<?php
/*
** CONTEST PORTAL v2 
** Created By Jonathan Zong (jonathanzong.com)
** scoreparse.php - Parse the scoreboard for easy entry into the database.
*/
///DIVISION HANDLING CHECK THE DB STRUCT
	$handle = @fopen("full.html", "r");
	if ($handle) {
		while (($buffer = fgets($handle)) !== false) {
			//echo $buffer;
			if(!strncmp($buffer, "<td>", 4)){
				$dat = trim(preg_replace('#<[^>]+>#', ' ', $buffer));
				echo $dat;
				echo "<br/>";
				
				$arr = explode(" ", $dat);
				if(count($arr) != 4)
					echo "I've got 99 problems";
				
					//TODO fix vars - NAME MUST BE SET AS KEY
				$query = "INSERT INTO table_name (name, rank, solved, time) VALUES ('{$ar[1]}', {$ar[0]}, {$ar[2]}, {$ar[3]}) ON DUPLICATE KEY UPDATE rank={$ar[0]}, solved={$ar[2]}, time={$ar[3]}";
				mysql_query($query) or die(mysql_error());
			}
		}
		if (!feof($handle)) {
			echo "Error: unexpected fgets() fail\n";
		}
		fclose($handle);
	}
?>