<?php
	function read_all($ordered = false)
	{
		$cds = array	(
						1 => array("Metallica", "Master of puppets", 1986),
						2 => array("Slayer","Reign in blood", 1986),
						3 => array("Megadeth", "Rust in peace", 1990),
						4 => array("Megadeth", "Endgame", 2009)
					);
		foreach($cds as $key => $value)
		{
			echo "<p>";
			echo "$value[0], $value[1], $value[2] (Key=$key)";
			echo "</p>";
		}
		// echo "<pre>";
		// print_r($cds);
		// echo "</pre>";
	}
?>