<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Benutzer-Editor</title>
		<meta name="description" content="Benutzer-Editor zum Editieren von Benutzern">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/page.css" type="text/css">
	</head>
	<body>
		<?php	
			//translations
			$editor;
			$languagemanager = new LanguageManager;
			if($languagemanager->language == "DE")
			{
				$editor = "Benutzer-Editor";
			}
			else if($languagemanager->language == "EN")
			{
				$editor = "User-Editor";
			}
			
			//output
			echo "<h1>$editor</h1>";
			$usermanager = new UserManager($languagemanager);
			$usermanager->handle_post();
		?>	</body>
</html>