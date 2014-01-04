<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Checkout</title>
		<meta name="description" content="Checkout ">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<?php	
			//translations
			$overview;
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				$overview = "Übersicht";
			}
			else if($languagemanager->language == "EN")
			{
				$overview = "Overview";
			}
			
			//output
			echo "<h1>$overview</h1";
			$manager = new CDManager($languagemanager->language);
			$manager->read_all();
		?>	</body>
</html>