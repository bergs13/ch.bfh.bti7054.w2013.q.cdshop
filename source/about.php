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
		
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				echo "<h1>";
				echo "Über";
				echo "</h1>";
				echo "<p>";
				echo "Adresse:<br/>";
				echo "Teh cdshop<br/>";
				echo "Wankdorffeldstrasse 102<br/>";
				echo "Bern";
				echo "</p>";
			}
			else if($languagemanager->language == "EN")
			{
				echo "<h1>";
				echo "About";
				echo "</h1>";
				echo "<p>";
				echo "Adress:<br/>";
				echo "Teh cdshop<br/>";
				echo "Wankdorffeldstrasse 102<br/>";
				echo "Bern";
				echo "</p>";
			}
		?>
	</body>
</html>