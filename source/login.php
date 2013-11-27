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
			echo "<h1>";
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				echo "Anmeldung";
			}
			else if($languagemanager->language == "EN")
			{
				echo "Login";
			}
			echo "</h1>";
		
			$authenticator = new Authenticator($languagemanager->language);
			$authenticator->handle_logout();
			$authenticator->display_login();
		?>
	</body>
</html>