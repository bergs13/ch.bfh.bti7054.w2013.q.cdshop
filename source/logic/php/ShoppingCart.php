<?php	
	class ShoppingCart
	{
		private $cartentries = array();
		public function __construct()
		{
		}
		public function handle_post()
		{
			if(isset($_POST["addcartcdid"]))
			{
				if(isset($_POST["cdinterpreter"])
					&& isset($_POST["cdtitle"])
					&& isset($_POST["cdprice"]))
				{
					$cartentry = new ShoppingCartEntry($_POST["addcartcdid"], $_POST["cdinterpreter"], $_POST["cdtitle"], $_POST["cdprice"]);
					$this->add_cd($_POST["addcartcdid"], $cartentry);
				}
			}
			else if(isset($_POST["removecartcdid"]))
			{
				$this->remove_cd($_POST["removecartcdid"]);
			}
		}
		public function get_checkout_html($language)
		{
			//manage language texts
			$interpreter;
			$title;
			$price;
			$count;
			$pricesum;
			if($language == "DE")
			{
				$interpreter = "Interpret";
				$title = "Titel";
				$price = "Preis";
				$count = "Menge";
				$pricesum = "Total";
			}
			else if($language = "EN")
			{
				$interpreter = "Interpreter";
				$title = "Title";
				$price = "Price";
				$count = "Amount";
				$pricesum = "Total";
			}
			
			$checkouthtml = "<table width=\"100%\"><tr><th>$interpreter</th><th>$title</th><th>$price</th><th>$count</th><th>$pricesum</th></tr>";
			$overallpricesum = 0.00;
			foreach ($this->cartentries as $id => $cartentry)
			{
				$checkouthtml .= $cartentry->as_tablerow();
				$overallpricesum += $cartentry->get_pricesum();
			}
			$checkouthtml .= "<tr><td colspan=\"5\" align=\"right\">$overallpricesum</td></tr></table>";
			return $checkouthtml;
		}
		public function display($language)
		{
			//manage language texts
			$shoppingcartlabel;
			$checkoutlabel;
			if($language == "DE")
			{
				$shoppingcartlabel = "Warenkorb";
				$checkoutlabel = "Gehe zu Kasse";
			}
			else if($language = "EN")
			{
				$shoppingcartlabel = "Shopping cart";
				$checkoutlabel = "Go to checkout";
			}
			
			//display cart, items and go to checkout button
			if(isset($this->cartentries))
			{
				$overallpricesum = 0.00;
				
				//cart 1/2
				echo "$shoppingcartlabel";
				echo "<br>";
				//cart items
				foreach ($this->cartentries as $id => $cartentry)
				{
					$cartentry->display();
					$overallpricesum += $cartentry->get_pricesum();
				}
				echo "<br>";
				//cart 2/2
				echo "Total: $overallpricesum";
				echo "<br><br>";
				//go to checkout button
				echo 	"<form action=\"index.php?page=checkout\" method=\"post\">";
				echo 	"<input type=\"submit\" value=\"$checkoutlabel\">";
				echo 	"</form>";
			}
		}
		private function add_cd($cdid, $cartentry)
		{
			//manage cdid texts
			if(!isset($this->cartentries))
			{
				//initialize
				$this->cartentries = array($cdid => $cartentry);
			}
			else
			{
				//increase quantity and price if already in cart
				if(array_key_exists($cdid, $this->cartentries))
				{
					$this->cartentries[$cdid]->increase_count();
				}
				//expand
				$temp = array($cdid => $cartentry);
				$this->cartentries = $this->cartentries + $temp;
			}
		}
		private function remove_cd($id) 
		{	
			if($this->cartentries[$id]->get_count() > 1)
			{
				$this->cartentries[$id]->decrease_count();
			}
			else
			{
				unset($this->cartentries[$id]);
			}
		}
	}
?>
				