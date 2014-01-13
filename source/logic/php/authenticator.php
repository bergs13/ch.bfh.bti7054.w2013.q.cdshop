<?php
	class Authenticator
	{
		private $userdatamanager;
		private $users;
		//labels
		private $username;
		private $password;
		private $login;
		public function __construct($language)
		{
			$this->userdatamanager = new UserDataManager;
            $this->users = $this->userdatamanager->get_all();
			
			//manage language texts
			if($language == "DE")
			{
				$this->username = "Benutzername";
				$this->password = "Passwort";
				$this->login = "Anmelden";
			}
			else if($language = "EN")
			{
				$this->username = "Username";
				$this->password = "Password";
				$this->login = "Login";
			}
		}
		public function display_login()
		{
			$this->handle_logout();
			echo "<p>";
			echo 	"<form action=\"index.php\" method=\"post\">";
			echo 		"<table>";
			echo			"<tr>";
			echo				"<td>$this->username:</td><td>$this->password:</td>";
			echo			"</tr>";
			echo 			"<tr>";
			echo				"<td><input name=\"user\"/></td><td><input type=\"password\" name=\"pw\"/></td>";
			echo			"</tr>";
			echo			"<tr>";
			echo				"<td><input type=\"submit\" value=\"$this->login\"/></td><td></td>";
			echo			"</tr>";
			echo		"</table>";
			echo 	"</form>";
			echo "</p>";
		}
		public function handle_login()
		{
			session_start();
			if(isset($_POST["user"])) 
			{
				$userValid = false;
				while ($user = $this->users->fetch_object()) 
				{
					if($_POST["user"]==$user->username 
						&& $_POST["pw"]==$user->password) 
					{
						$userValid = true;
						$_SESSION["user"]=$_POST["user"];
						break;
					}
				}
				if(!$userValid) 
				{
					echo "login failed";
				}
			}
		}
		public function handle_logout()
		{	
			@session_start(); // create or recover session,
			session_unset(); // ... delete all session variables,
			session_destroy(); // ... and end it
		}
		public function is_logged_in()
		{
			return isset($_SESSION["user"]);
		}
		public function is_administrator()
		{
			if($this->is_logged_in())
			{
				return $_SESSION["user"] == "admin";
			}
			return false;
		}
	}
?>