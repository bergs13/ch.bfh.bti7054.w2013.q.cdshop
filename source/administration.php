<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Administration</title>
		<meta name="description" content="Administration des CD Shops.">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
		<script type="text/javascript">
			function switch_div(divname)
			{
				if (document.getElementById(divname).style.display=="none")
				{
					document.getElementById(divname).style.display="";
				}
				else
				{
					document.getElementById(divname).style.display="none";
				}
			}
		</script>
	</head>
	<body>
		<?php
			//translations
			$administration;
			$useradmin;
			$cdadmin;
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				$administration = "Administration";
				$useradmin = "Benutzer verwalten";
				$cdadmin = "CDs verwalten";
			}
			else /*if($languagemanager->language == "EN")*/
			{
				$administration = "Administration";
				$useradmin = "Manage users";
				$cdadmin = "Manage CDs";
			}
			
			//page output
			echo "<h1>$administration</h1>";
			//user admin
			echo "<h2 value=\"show\" onclick=\"javascript:switch_div('useradmin')\">$useradmin</h2>";
			echo "<div id=\"useradmin\">";
			$usermanager = new UserManager($languagemanager->language);
			$usermanager->handle_post();
			echo "</div>";
		
			//cd admin
			echo "<h2 value=\"show\" onclick=\"javascript:switch_div('cdadmin')\">$cdadmin</h2>";
			echo "<div id=\"cdadmin\">";
			$cdmanager = new CDManager($languagemanager->language);
			$cdmanager->handle_post();
			echo "</div>";
		?>
	</body>
</html>