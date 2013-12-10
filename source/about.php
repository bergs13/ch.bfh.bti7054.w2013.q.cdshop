<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>About</title>
		<meta name="description" content="Infos über den CD-Shop">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<?php
			$about;
			$adress;
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				$about = "Über";
				$adress = "Adresse";
			}
			else /*if($languagemanager->language == "EN")*/
			{
				$about = "About";
				$adress = "Adress";
			}
			echo "<h1>$about</h1>";
			echo "<p>";
			echo "$adress:<br/>";
			echo "Teh cdshop<br/>";
			echo "Wankdorffeldstrasse 102<br/>";
			echo "3000 Bern";
			echo "</p>";
		?>
	</body>
</html>