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
			echo "<h1>";
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				echo "TODO: Administration";
			}
			else if($languagemanager->language == "EN")
			{
				echo "TODO: Administration";
			}
			echo "</h1>";
		?>
	</body>
</html>