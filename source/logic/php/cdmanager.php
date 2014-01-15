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
		private $savelabel;
		private $cancellabel;
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
				$this->savelabel = "Speichern";
				$this->cancellabel = "Abbrechen";
			}
			else if($language = "EN")
			{
				$this->addtocartlabel = "Add to cart";
				$this->addlabel = "Add";
				$this->editlabel = "Update";
				$this->deletelabel = "Delete";
				$this->savelabel = "Save";
				$this->cancellabel = "Cancel";
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
				if($_POST["savecdid"] < 0)
				{	
					if(isset($_POST["cdtype"])
						&& isset($_POST["cdcategory"])
						&& isset($_POST["cdgenre"])
						&& isset($_POST["interpreter"])
						&& isset($_POST["title"])
						&& isset($_POST["year"])
						&& isset($_POST["price"]))
					{
						$this->cddatamanager->insert($_POST["cdtype"], $_POST["cdcategory"], $_POST["cdgenre"], $_POST["interpreter"],
													$_POST["title"], $_POST["year"], $_POST["price"]);
					}
				}
				//Add
				else		
				{
					if(isset($_POST["cdtype"])
						&& isset($_POST["cdcategory"])
						&& isset($_POST["cdgenre"])
						&& isset($_POST["interpreter"])
						&& isset($_POST["title"])
						&& isset($_POST["year"])
						&& isset($_POST["price"]))
					{
						$this->cddatamanager->update($_POST["cdtype"], $_POST["cdcategory"], $_POST["cdgenre"], $_POST["interpreter"],
													$_POST["title"], $_POST["year"], $_POST["price"], $_POST["savecdid"]);				
					}
				}
				$this->get_adminoverview();
			}
			else if(isset($_POST["deletecdid"]))
			{
				$this->cddatamanager->delete($_POST["deletecdid"]);
				$this->get_adminoverview();
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
			$languagemanager = new LanguageManager;
			$authenticator = new Authenticator($languagemanager->language);
			if($authenticator->is_administrator())
			{
				echo "<form action=\"index.php?page=administration\" method=\"post\">";
			}
			else
			{
				echo "<form action=\"\" method=\"post\">";
			}
			echo "<table>";
			//radios
			echo "<tr>";
			echo "<td valign=\"top\">Type:</td><td valign=\"top\">";
					$checked = "";
					while($cdtype = $cdtypes->fetch_object())
					{
						if($cdtype->id == $cdtypeid)
						{
							$checked = "checked";
						}
						else 
						{
							$checked = "";
						}
						echo "<input type=\"radio\" name=\"cdtype\" value=\"$cdtype->id\" $checked>$cdtype->name</input><br>";
					}
					echo "<br>";
			echo "</td><td width=\"50px\" rowspan=\"2\"></td>";
			echo "<td valign=\"top\">Genre:</td><td valign=\"top\" rowspan=\"2\">";
					$checked = "";
					while($cdgenre = $cdgenres->fetch_object())
					{	
						if($cdgenre->id == $cdgenreid)
						{
							$checked = "checked";
						}
						else 
						{
							$checked = "";
						}
						echo "<input type=\"radio\" name=\"cdgenre\" value=\"$cdgenre->id\" $checked>$cdgenre->name</input><br>";
					}
					echo "<br>";
			echo "</td>";
			echo "</tr>";
			echo "<tr><td valign=\"top\">Category:</td><td valign=\"top\">";
					$checked = "";
					while($cdcategory = $cdcategories->fetch_object())
					{
						if($cdcategory->id == $cdcategoryid)
						{
							$checked = "checked";
						}
						else 
						{
							$checked = "";
						}
						echo "<input type=\"radio\" name=\"cdcategory\" value=\"$cdcategory->id\" $checked>$cdcategory->name</input><br>";
					}
					echo "<br>";
			echo "</td><td width=\"50px\"></td><td></td>";
			
			//texts
			echo "<tr><td>Interpreter:</td><td><input name=\"interpreter\" value=\"$interpreter\"></input></td></tr>";
			echo "<tr><td>Title:</td><td><input name=\"title\" value=\"$title\"></input></td></tr>";
			echo "<tr><td>Year:</td><td><input name=\"year\" value=\"$year\"></input></td></tr>";
			echo "<tr><td>Price:</td><td><input name=\"price\" value=\"$price\"></input></td></tr>";
			//save/cancel buttons 
			echo "<tr><td colspan=\"2\">";
					echo "<input type=\"hidden\" name=\"savecdid\" value=\"$id\">";
					echo "<input type=\"submit\" value=\"$this->savelabel\">";
				
					if($authenticator->is_administrator())
					{
						echo "<form action=\"index.php?page=administration\" method=\"post\">";
					}
					else
					{
						echo "<form action=\"\" method=\"post\">";
					}
					echo "<input type=\"submit\" name=\"cdsavecancelled\" value=\"$this->cancellabel\"";
					echo "</td></tr>";
					echo "</form>";
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
				echo "<form action=\"index.php?page=cdeditor\" method=\"post\">";
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
				echo "$cd->interpreter, $cd->title ($cd->year), $cd->price";
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
						echo "<td>";
						echo "<form action=\"index.php?page=cdeditor\" method=\"post\">";
						echo "<input type=\"hidden\" name=\"showeditorid\" value=\"$cd->id\">";
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
				}
				
				echo "</tr>";
				echo "</table>";
				echo "</p>";
			}
		}
	}
?>