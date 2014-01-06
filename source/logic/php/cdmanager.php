<?php
	class CDManager
	{
		private $cddatamanager;
		private $cds;
		//description lists
		private $cdtypes;
		private $cdcategories;
		private $cdgenres;
		//labels
		private $addtocartlabel;
		private $addlabel;
		private $editlabel;
		private $deletelabel;
		public function __construct($language)
		{
			$this->cddatamanager = new CDDataManager; 
			
			//manage language texts
			if($language == "DE")
			{
				$this->addtocartlabel = "In den Warenkorb";
				$this->addlabel = "Hinzufügen";
				$this->editlabel = "Bearbeiten";
				$this->deletelabel = "Löschen";
			}
			else if($language = "EN")
			{
				$this->addtocartlabel = "Add to cart";
				$this->addlabel = "Add";
				$this->editlabel = "Update";
				$this->deletelabel = "Delete";
			}
			
			//load the description lists
			$descriptionmanager = new DescriptionDataManager;
			$this->cdtypes = $descriptionmanager->get_cdtypes();
			$this->cdcategories = $descriptionmanager->get_cdcategories();
			$this->cdgenres = $descriptionmanager->get_cdgenres();	
		}
		public function get_overview()
		{
			$this->cds = $this->cddatamanager->get_all();
			$this->display_list(true);
		} 
		public function handle_post()
		{
			if(isset($_POST["addcd"]))
			{
				$this->get_adminaddview();
			}
			else if(isset($_POST["editcdid"]))
			{
				$this->get_admineditview($_POST["editcdid"]);
			}
			else if(isset($_POST["deletecdid"]))
			{
				$this->cddatamanager->delete($_POST["deletecdid"]);
			}
			else
			{
				$this->get_adminoverview();
			}
		}
		private function get_adminaddview()
		{
			echo "Add view";
			
		}
		private function get_admineditview($cdid)
		{
			$result = $this->cddatamanager->get_cd($cdid);
			if($result)
			{
				echo $result->id;
				echo "</br>";
				echo $result->interpreter;
				echo "</br>";
				echo $result->title;
			}			
		}
		private function get_adminoverview()
		{
			$this->cds = $this->cddatamanager->get_all();
			$this->display_list(false);
		} 
		private function display_list($readonly)
		{
			//cds with details $readonly dependenta action forms/buttons
			if(!$readonly)
			{
				echo "<form action=\"\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"addcd\">";
				echo "<input type=\"submit\" value=\"$this->addlabel\">";
				echo "</form>";
			}
			while ($cd = $this->cds->fetch_object()) 
			{
				echo "<p>";
				echo "<table>";
				echo "<tr>";
				echo "<td>";
				echo "$cd->interpreter, $cd->title, $cd->year (Key=$cd->id)";
				echo "</td>";
				
				if($readonly)
				{
					echo "<td>";
					echo "<form action=\"\" method=\"post\">";
					echo "<input type=\"hidden\" name=\"addcartcdid\" value=\"$cd->id\">";
					echo "<input type=\"hidden\" name=\"cdinterpreter\" value=\"$cd->interpreter\">";
					echo "<input type=\"hidden\" name=\"cdtitle\" value=\"$cd->title\">";
					echo "<input type=\"hidden\" name=\"cdprice\" value=\"$cd->price\">";
					echo "<input type=\"submit\" value=\"$this->addtocartlabel\">";
					echo "</form>";
					echo "</td>";
				}
				else
				{
					echo "<td>";
					echo "<form action=\"\" method=\"post\">";
					echo "<input type=\"hidden\" name=\"editcdid\" value=\"$cd->id\">";
					echo "<input type=\"submit\" value=\"$this->editlabel\">";
					echo "</form>";
					echo "</td>";
					echo "<td>";
					echo "<form action=\"\" method=\"post\">";
					echo "<input type=\"hidden\" name=\"deletecdid\" value=\"$cd->id\">";
					echo "<input type=\"submit\" value=\"$this->deletelabel\">";
					echo "</form>";
					echo "</td>";
				}
				
				echo "</tr>";
				echo "</table>";
				echo "</p>";
			}
		}
	}
?>