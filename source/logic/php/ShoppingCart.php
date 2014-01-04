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
				//go to checkout button 1
				echo 	"<form action=\"index.php?page=checkout.php\" method=\"post\">";
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
				