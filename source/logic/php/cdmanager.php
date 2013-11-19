<?php
	class CDManager
	{
		private $cds = array();
		public function read_all($display = true, $ordered = false, $descending = false)
		{
			//Getting array data
			$this->cds = array	(
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
					rsort($this->cds);
				}
				else
				{
					sort($this->cds);
				}
			}		
			
			//Display if specified
			if($display)
			{
				$this->display_all();
			}
		}
		private function display_all()
		{
			//Display the array
			foreach($this->cds as $key => $value)
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
			// print_r($this->cds);
			// echo "</pre>";
		}
	}
?>