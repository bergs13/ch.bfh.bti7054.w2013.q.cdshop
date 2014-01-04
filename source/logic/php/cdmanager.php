<?php
	class CDManager
	{
		private $cddatamanager;
		private $cds;
		//labels
		private $addtocartlabel;
		public function __construct($language)
		{
			$this->cddatamanager = new CDDataManager; 
			
			//manage language texts
			if($language == "DE")
			{
				$this->addtocartlabel = "In den Warenkorb";
			}
			else if($language = "EN")
			{
				$this->addtocartlabel = "Add to cart";
			}
		}
		public function read_all($ordered = false, $descending = false)
		{
			$this->cds = $this->cddatamanager->get_all($ordered, $descending);
			$this->display_list();
		} 
		private function display_list()
		{
			//cds with details ans add to cart buttons
			while ($cd = $this->cds->fetch_object()) 
			{
				echo "<p>";
				echo "<table>";
				echo "<tr>";
				echo "<td>";
				echo "$cd->interpreter, $cd->title, $cd->year (Key=$cd->id)";
				echo "</td>";
				echo "<td>";
				echo "<form action=\"\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"addcartcdid\" value=\"$cd->id\">";
				echo "<input type=\"hidden\" name=\"cdinterpreter\" value=\"$cd->interpreter\">";
				echo "<input type=\"hidden\" name=\"cdtitle\" value=\"$cd->title\">";
				echo "<input type=\"hidden\" name=\"cdprice\" value=\"$cd->price\">";
				echo "<input type=\"submit\" value=\"$this->addtocartlabel\">";
				echo "</form>";
				echo "</td>";
				echo "</tr>";
				echo "</table>";
				echo "</p>";
			}
		}
	}
?>