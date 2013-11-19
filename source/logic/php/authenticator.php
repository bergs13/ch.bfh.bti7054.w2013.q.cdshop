<?php
	class Authenticator
	{
		public function display_login()
		{
			$this->handle_logout();
			echo "<p>";
			echo "<form action=\"index.php\" method=\"post\">";
			echo "<input name=\"user\" /> User Name<br />";
			echo "<input type=\"password\" name=\"pw\" /> Password<br />";
			echo "<input type=\"submit\" value=\"Login\" />";
			echo "</form>";
			echo "</p>";
		}
		public function handle_login()
		{
			if(!isset($_SESSION)) 
			{
				session_start();
			}
			if(isset($_POST["user"])) 
			{
				if($_POST["user"]=="bergs13" && $_POST["pw"]=="test") 
				{
					$_SESSION["user"]=$_POST["user"];
				}
			}
		}
		public function handle_logout()
		{
			if(!isset($_SESSION)) 
			{
				session_start(); // create or recover session,
			}
			session_unset(); // ... delete all session variables,
			session_destroy(); // ... and end it
		}
		public function manage_menuitems($navigator)
		{
			if($navigator instanceof Navigator)
			{
				$navigator->set_pages(isset($_SESSION["user"]));
			}
			else
			{
				echo "class parameter error in Authenticator manage_menuitems";
			}
		}
	}
?>