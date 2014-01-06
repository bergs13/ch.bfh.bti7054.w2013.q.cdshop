<?php
	class UserManager
	{
		private $userdatamanager;
		private $users;
		//labels
		private $addlabel;
		private $editlabel;
		private $deletelabel;
		public function __construct($language)
		{
			$this->userdatamanager = new UserDataManager; 
			
			//manage language texts
			if($language == "DE")
			{
				$this->addlabel = "Hinzufügen";
				$this->editlabel = "Bearbeiten";
				$this->deletelabel = "Löschen";
			}
			else if($language = "EN")
			{
				$this->addlabel = "Add";
				$this->editlabel = "Update";
				$this->deletelabel = "Delete";
			}
		}
		public function handle_post()
		{
			if(isset($_POST["adduser"]))
			{
				$this->get_adminaddview();
			}
			else if(isset($_POST["edituserid"]))
			{
				$this->get_admineditview($_POST["edituserid"]);
			}
			else if(isset($_POST["deleteuserid"]))
			{
				$this->userdatamanager->delete($_POST["deleteuserid"]);
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
		private function get_admineditview($userid)
		{
			$result = $this->userdatamanager->get_user($userid);
			if($result)
			{
				echo $result->id;
				echo "</br>";
				echo $result->username;
				echo "</br>";
				echo $result->password;
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
			echo "<form action=\"\" method=\"post\">";
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
				echo "<form action=\"\" method=\"post\">";
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