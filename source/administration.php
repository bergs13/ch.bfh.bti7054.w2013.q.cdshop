<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Administration</title>
		<meta name="description" content="Administration des CD Shops.">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
		<script type="text/javascript">
			function switchuseradmin()
			{
				if (document.getElementById("useradmin").style.display=="none")
				{
					document.getElementById("useradmin").style.display="";
				}
				else
				{
					document.getElementById("useradmin").style.display="none";
				}
			}
			function switchcdadmin()
			{
				if (document.getElementById("cdadmin").style.display=="none")
				{
					document.getElementById("cdadmin").style.display="";
				}
				else
				{
					document.getElementById("cdadmin").style.display="none";
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
			echo "<h2 value=\"show\" onclick=\"javascript:switchuseradmin()\">$useradmin</h2>";
			echo "<div id=\"useradmin\">";
			echo "TEST";
			echo "</div>";
			echo "<h2 value=\"show\" onclick=\"javascript:switchcdadmin()\">$cdadmin</h2>";
			echo "<div id=\"cdadmin\">";
			$manager = new CDManager($languagemanager->language);
			$manager->read_all_for_edit();
			echo "</div>";
		?>
	</body>
</html>