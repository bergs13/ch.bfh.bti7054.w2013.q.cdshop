<?php
	class ShoppingCartEntry
	{
		private $cdid = array();
		private $cdinterpreter;
		private $cdtitle;
		private $count;
		private $price;
		private $pricesum;
		public function __construct($cdid, $cdinterpreter, $cdtitle, $price)
		{
			$this->cdid = $cdid;
			$this->cdinterpreter = $cdinterpreter;
			$this->cdtitle = $cdtitle;
			$this->count = 1;
			$this->price = $price;
			$this->pricesum = $price;
		}
		public function get_count()
		{
			return $this->count;
		}
		public function increase_count()
		{
			$this->count += 1;
			$this->pricesum += $this->price;
		}
		public function decrease_count()
		{
			$this->count -= 1;
			$this->pricesum -= $this->price;
		}
		public function get_pricesum()
		{
			return $this->pricesum;
		}
		public function display()
		{
			echo "<div id=\"shoppingcartentry\">";
			echo	"<table>";
			echo 	"<tr><td colspan=\"2\">$this->cdinterpreter</td></tr>";
			echo 	"<tr><td colspan=\"2\">$this->cdtitle</td></tr>";
			echo 	"<tr><td colspan=\"2\">Count: ".$this->count." Price: ".$this->pricesum."</td></tr>";
			echo	"<tr>";
			echo	"<td>";
						//(+)-Button
			echo 		"<form action=\"\" method=\"post\">";
			echo 		"<input type=\"hidden\" name=\"addcartcdid\" value=\"$this->cdid\">";
			echo 		"<input type=\"hidden\" name=\"cdinterpreter\" value=\"$this->cdinterpreter\">";
			echo 		"<input type=\"hidden\" name=\"cdtitle\" value=\"$this->cdtitle\">";
			echo 		"<input type=\"hidden\" name=\"cdprice\" value=\"$this->price\">";
			echo 		"<input type=\"submit\" value=\"+\">";
			echo 		"</form>";
			echo	"</td>";
			echo	"<td>";
						//(-)-Button
			echo 		"<form action=\"\" method=\"post\">";
			echo 		"<input type=\"hidden\" name=\"removecartcdid\" value=\"$this->cdid\">";
			echo 		"<input type=\"submit\" value=\"-\">";
			echo 		"</form>";
			echo	"</td>";
			echo	"</tr>";
			echo	"</table>";
			echo "</div";
		}
	}
?>
				