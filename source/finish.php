<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Finish</title>
		<meta name="description" content="Seite für den erfolgreichen Bestellungsabschluss">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<?php
			//translations
			$finish;
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				$finish = "Schlussbericht";
			}
			else if($languagemanager->language == "EN")
			{
				$finish = "Final report";
			}
		
			//output
			echo "<h2>$finish</h2>";
			//send the order only if a shopping cart is set
			if (isset($_SESSION["shoppingcart"]))
			{
				$shoppingcart = $_SESSION["shoppingcart"];
				$order = new Order($languagemanager->language);
				$order->set_producthtml($shoppingcart->get_checkout_html($languagemanager->language));
				$order->handle_post();
			}
			else
			{
				echo "Error! No session variable set for the shopping cart!";
			}
		?>
	</body>
</html>