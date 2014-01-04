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
			echo 	"$this->cdinterpreter</br>";
			echo 	"$this->cdtitle</br>";
			echo 	"Count: ".$this->count." Price: ".$this->pricesum."</br>";
			echo "</div";
		}
	}
?>
				