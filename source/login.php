<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Login</title>
		<meta name="description" content="Maske für das Einloggen in den CD-Shop">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<?php
			//translations
			$login;
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				$login = "Anmeldung";
			}
			else if($languagemanager->language == "EN")
			{
				$login = "Login";
			}
			
			//output
			echo "<h1>$login</h1>";
			$authenticator = new Authenticator($languagemanager->language);
			$authenticator->handle_logout();
			$authenticator->display_login();
		?>
	</body>
</html>