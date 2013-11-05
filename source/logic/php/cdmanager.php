<?php
	$cds = array();
	function read_all($display = true, $ordered = false, $descending = false)
	{
		global $cds;
		//Getting array data
		$cds = array	(
						1 => array("Metallica", "Master of puppets", 1986),
						2 => array("Slayer","Reign in blood", 1986),
						3 => array("Megadeth", "Rust in peace", 1990),
						4 => array("Megadeth", "Endgame", 2009)
					);
		
		//Order the array if specified
		if($ordered)
		{
			if($descending)
			{
				rsort($cds);
			}
			else
			{
				sort($cds);
			}
		}		
		
		//Display if specified
		if($display)
		{
			display_all();
		}
	}
	function display_all()
	{
		global $cds;
		//Display the array
		foreach($cds as $key => $value)
		{
			echo "<p>";
			echo "<table>";
			echo "<tr>";
			echo "<td>";
			echo "$value[0], $value[1], $value[2] (Key=$key)";
			echo "</td>";
			echo "<td>";
			echo "<form action=\"11_FormA.php\" method=\"get\">";
			echo "<input type=\"hidden\" name=\"cdId\" value=\"$key\">";
			echo "<input type=\"submit\" value=\"Add to cart\">";
			echo "</form>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
			echo "</p>";
		}
		// echo "<pre>";
		// print_r($cds);
		// echo "</pre>";
	}
?>