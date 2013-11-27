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
			while ($cd = $this->cds->fetch_object()) 
			{
				echo "<p>";
				echo "<table>";
				echo "<tr>";
				echo "<td>";
				echo "$cd->interpreter, $cd->album, $cd->year (Key=$cd->id)";
				echo "</td>";
				echo "<td>";
				echo "<form action=\"11_FormA.php\" method=\"get\">";
				echo "<input type=\"hidden\" name=\"cdId\" value=\"$cd->id\">";
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