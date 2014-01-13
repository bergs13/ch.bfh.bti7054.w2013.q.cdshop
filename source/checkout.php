<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Checkout</title>
		<meta name="description" content="Kasse zum spezifizieren und absenden einer Bestellung">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<?php	
			//translations
			$checkout;
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				$checkout = "Kasse";
			}
			else if($languagemanager->language == "EN")
			{
				$checkout = "Checkout";
			}
			
			//output
			echo "<h1>$checkout</h1";
		?>	</body>
</html>