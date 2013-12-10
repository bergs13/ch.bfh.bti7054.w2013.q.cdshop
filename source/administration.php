<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Administration</title>
		<meta name="description" content="Administration des CD Shops.">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
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
		?>
	</body>
</html>