<?php
	class CDManager
	{
		private $cddatamanager;
		private $cds;
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
		}
		public function get_overview($isloggedin)
		{
			$this->cds = $this->cddatamanager->get_all();
			$this->display_list(true, $isloggedin);
		} 
		public function handle_post()
		{
			if(isset($_POST["showeditor"]))
			{
				$this->get_editorview();
			}
			else if(isset($_POST["showeditorid"]))
			{
				$this->get_editorview($_POST["showeditorid"]);
			}
			else if(isset($_POST["savecdid"]))
			{
				//Edit
				if($_POST("savecdid") > 0)
				{
				}
				//Add
				else		
				{
				}
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
		private function get_editorview($cdid = -1)
		{
			//load the description lists
			$descriptionmanager = new DescriptionDataManager;
			$cdtypes = $descriptionmanager->get_cdtypes();
			$cdcategories = $descriptionmanager->get_cdcategories();
			$cdgenres = $descriptionmanager->get_cdgenres();	
			
			//set the values for the form fields
			//add values
			$id = -1;
			$cdtypeid = -1;
			$cdcategoryid = -1;
			$cdgenreid = -1;
			$interpreter = "";
			$title = "";
			$year = "1900";
			$price = 0.00;
			//overwrite with db values if id set
			if($cdid > 0)
			{
				$cd = $this->cddatamanager->get_cd($cdid);
				if($cd)
				{
					$id = $cd->id;
					$cdtypeid = $cd->cdtypeid;
					$cdcategoryid = $cd->cdcategoryid;
					$cdgenreid = $cd->cdgenreid;
					$interpreter = $cd->interpreter;
					$title = $cd->title;
					$year = $cd->year;
					$price = $cd->price;
				}			
			}
			
			//form output
			echo "<form action=\"\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"savecdid\" value=\"$cd->id\">";
			echo "<table>";
			//radios
			echo "<tr><td>Type:</td><td>";
					$checked;
					while($cdtype = $cdtypes->fetch_object())
					{
						$checked = "checked=\"unchecked\"";
						if($cdtype->id == $cdtypeid)
						{
							$checked = "checked=\"checked\"";
						}
						echo "<input type=\"radio\" name=\"cdtype\" value=\"$cdtype->id\" $checked>$cdtype->name</input><br>";
					}
					echo "<br>";
			echo "</td></tr>";
			echo "<tr><td>Category:</td><td>";
					while($cdcategory = $cdcategories->fetch_object())
					{
						$checked = "checked=\"unchecked\"";
						if($cdcategory->id == $cdcategoryid)
						{
							$checked = "checked=\"checked\"";
						}
						echo "<input type=\"radio\" name=\"cdcategory\" value=\"$cdcategory->id\" $checked>$cdcategory->name</input><br>";
					}
					echo "<br>";
			echo "</td></tr>";
			echo "<tr><td>Genre:</td><td>";
					while($cdgenre = $cdgenres->fetch_object())
					{	
						$checked = "checked=\"unchecked\"";
						if($cdgenre->id == $cdgenreid)
						{
							$checked = "checked=\"checked\"";
						}
						echo "<input type=\"radio\" name=\"cdgenre\" value=\"$cdgenre->id\" $checked>$cdgenre->name</input><br>";
					}
					echo "<br>";
			echo "</td></tr>";
			//texts
			echo "<tr><td>Interpreter:</td><td><input name=\"interpreter\" value=\"$interpreter\"></input></td></tr>";
			echo "<tr><td>Title:</td><td><input name=\"title\" value\"$title\"></input></td></tr>";
			echo "<tr><td>Year:</td><td><input name=\"year\" value\"$year\"></input></td></tr>";
			echo "<tr><td>Price:</td><td><input name=\"price\" value\"$price\"></input></td></tr>";
			//save/cancel buttons 
			echo "<tr><td colspan=\"2\"><input type=\"submit\" value=\"Save\"><input type=\"submit\" value=\"Cancel\"</td></tr>";
			echo "</table>";
			echo "</form>";
		}
		private function get_adminoverview()
		{
			$this->cds = $this->cddatamanager->get_all();
			$this->display_list(false);
		} 
		private function display_list($readonly, $isloggedin = true)
		{
			//cds with details $readonly dependenta action forms/buttons
			if(!$readonly)
			{
				echo "<form action=\"\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"showeditor\">";
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
				
				if($isloggedin)
				{
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
						echo "<td colspan=\"2\">";
						echo "<form action=\"\" method=\"post\">";
						echo "<input type=\"hidden\" name=\"showeditorid\" value=\"$cd->id\">";
						echo "<input type=\"submit\" value=\"$this->editlabel\">";
						echo "</form>";
						echo "<form action=\"\" method=\"post\">";
						echo "<input type=\"hidden\" name=\"deletecdid\" value=\"$cd->id\">";
						echo "<input type=\"submit\" value=\"$this->deletelabel\">";
						echo "</form>";
						echo "</td>";
					}
				}
				
				echo "</tr>";
				echo "</table>";
				echo "</p>";
			}
		}
	}
?>