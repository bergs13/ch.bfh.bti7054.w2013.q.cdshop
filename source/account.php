<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Account</title>
		<meta name="description" content="Benutzerdaten anpassen">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<?php
			//translations
			$account;
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				$account = "Konto";
			}
			else /*if($languagemanager->language == "EN")*/
			{
				$account = "Account";
			}
			
			//output
			echo "<h1>$account</h1>";
			$usermanager = new UserManager($languagemanager->language);
			$usermanager->handle_post(false);
			if(isset($_SESSION["userid"]))
			{
				$usermanager->get_editorview($_SESSION["userid"]);
			}
		?>
	</body>
</html>