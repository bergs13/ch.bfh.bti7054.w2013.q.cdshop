<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>CD-Übersicht</title>
		<meta name="description" content="CD-Übersicht zum stöbern">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<?php	
			echo "<h1>";
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				echo "Übersicht";
			}
			else if($languagemanager->language == "EN")
			{
				echo "Overview";
			}
			echo "</h1>";
			
			$manager = new CDManager($languagemanager->language);
			$manager->read_all();
		?>	</body>
</html>