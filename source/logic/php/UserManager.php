<?php
	class UserManager
	{
		private $language;
		private $userdatamanager;
		private $users;
		//labels
		private $addlabel;
		private $editlabel;
		private $deletelabel;
		private $savelabel;
		private $cancellabel;
		public function __construct($language)
		{	
			$this->language = $language;
			$this->userdatamanager = new UserDataManager; 
			
			//manage language texts
			if($this->language == "DE")
			{
				$this->addlabel = "Hinzufügen";
				$this->editlabel = "Bearbeiten";
				$this->deletelabel = "Löschen";
				$this->savelabel = "Speichern";
				$this->cancellabel = "Abbrechen";
			}
			else if($this->language = "EN")
			{
				$this->addlabel = "Add";
				$this->editlabel = "Update";
				$this->deletelabel = "Delete";
				$this->savelabel = "Save";
				$this->cancellabel = "Cancel";
			}
		}
		public function get_editorview($userid = -1)
		{			
			//set the values for the form fields
			//add values
			$id = -1;
			$username = "";
			$password = "";
			//overwrite with db values if id set
			if($userid > 0)
			{
				$user = $this->userdatamanager->get_user($userid);
				if($user)
				{
					$id = $user->id;
					$username = $user->username;
					$password = $user->password;
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
				echo "<form action=\"index.php?page=account\" method=\"post\">";
			}
			echo "<table>";
			//texts
			echo "<tr><td>Username:</td><td><input name=\"username\" value=\"$username\"></input></td></tr>";
			echo "<tr><td>Password:</td><td><input name=\"password\" value=\"$password\"></input></td></tr>";
			//save/cancel buttons 
			echo "<tr><td colspan=\"2\">";
					echo "<input type=\"hidden\" name=\"saveuserid\" value=\"$id\">";
					echo "<input type=\"submit\" name=\"saveuser\" value=\"$this->savelabel\">";
					if($authenticator->is_administrator())
					{
						echo "<form action=\"index.php?page=administration\" method=\"post\">";
					}
					else
					{
						echo "<form action=\"index.php?page=account\" method=\"post\">";
					}
					if($authenticator->is_administrator())
					{
						echo "<input type=\"submit\" name=\"usersavecancelled\" value=\"$this->cancellabel\"";
					}
					echo "</td></tr>";
					echo "</form>";
			echo "</table>";
			echo "</form>";
		}
		public function handle_post($isadmin = true)
		{
			if($isadmin)
			{
				if(isset($_POST["adduser"]))
				{
					$this->get_editorview();
				}
				else if(isset($_POST["edituserid"]))
				{
					$this->get_editorview($_POST["edituserid"]);
				}
				else if(isset($_POST["saveuser"])
						&& isset($_POST["saveuserid"]))
				{
					//Edit
					if($_POST["saveuserid"] < 0)
					{
						if(isset($_POST["username"])
							&& isset($_POST["password"]))
						{
							$this->userdatamanager->insert($_POST["username"], $_POST["password"]);
						}
					}
					//Add
					else		
					{
						if(isset($_POST["username"])
							&& isset($_POST["password"]))
						{
							$this->userdatamanager->update($_POST["username"], $_POST["password"], $_POST["saveuserid"]);
						}
					}
					$this->get_adminoverview();
				}
				else if(isset($_POST["deleteuserid"]))
				{
					$this->userdatamanager->delete($_POST["deleteuserid"]);
					$this->get_adminoverview();
				}
				else
				{
					$this->get_adminoverview();
				}
			}
			else if(isset($_POST["saveuser"])
				&& isset($_POST["saveuserid"]))
			{
				//Only edit of personal user allowed
				if($_POST["saveuserid"] > 0 
					&& isset($_SESSION["userid"])
					&& $_POST["saveuserid"] == $_SESSION["userid"])
				{
					if(isset($_POST["username"])
						&& isset($_POST["password"]))
					{
						$this->userdatamanager->update($_POST["username"], $_POST["password"], $_POST["saveuserid"]);
						$datasaved;
						if($this->language == "DE")
						{
							$datasaved = "Daten erfolgreich gespeichert!";
						}
						else if($this->language = "EN")
						{
							$datasaved = "Data saved sucessfully!";
						}
						echo $datasaved;
					}
				}
			}
		}
		private function get_adminoverview()
		{
			$this->users = $this->userdatamanager->get_all();
			$this->display_list();
		} 
		private function display_list()
		{
			//users with details and action forms/buttons
			echo "<form action=\"index.php?page=usereditor\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"adduser\">";
			echo "<input type=\"submit\" value=\"$this->addlabel\">";
			echo "</form>";
			while ($user = $this->users->fetch_object()) 
			{
				echo "<p>";
				echo "<table>";
				echo "<tr>";
				echo "<td>";
				echo "$user->username, $user->password";
				echo "</td>";
				echo "<td>";
				echo "<form action=\"index.php?page=usereditor\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"edituserid\" value=\"$user->id\">";
				echo "<input type=\"submit\" value=\"$this->editlabel\">";
				echo "</form>";
				echo "</td>";
				echo "<td>";
				echo "<form action=\"\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"deleteuserid\" value=\"$user->id\">";
				echo "<input type=\"submit\" value=\"$this->deletelabel\">";
				echo "</form>";
				echo "</td>";				
				echo "</tr>";
				echo "</table>";
				echo "</p>";
			}
		}
	}
?>