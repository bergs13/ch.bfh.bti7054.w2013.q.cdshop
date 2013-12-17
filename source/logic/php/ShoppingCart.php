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
		public function display()
		{
			if(isset($this->cartentries))
			{
				echo "Shopping cart v1.0</br>";
				echo "<p>";
				$overallpricesum = 0.00;
				foreach ($this->cartentries as $id => $cartentry)
				{
					$cartentry->display();
					$overallpricesum += $cartentry->get_pricesum();
					echo "<br/>";
				}
				echo "</p>";
				echo "Total: $overallpricesum";
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
				