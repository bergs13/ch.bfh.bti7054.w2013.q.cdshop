<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>CD Shop</title>
		<meta name="description" content="Projekt CD Shop für das Modul Web programming (BTI7054)">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/design.css" type="text/css">
	</head>
	<body>
		<?php
			//Generelles
			//Autoload for all used classes
			function __autoload($class_name) 
			{
				require_once("logic/php/".$class_name.".php");
			}
			
			//Authenticator handles login if needed (Post-Check)
			$authenticator = new Authenticator;
			$authenticator->handle_login();
			//Authenticator manages menu pages of navigator
			$navigator = new Navigator(true);
			$authenticator->manage_menuitems($navigator);						
		?>
		<div id="site">
			<div id="header">
				<img src="resources/design/header.png" alt="error loading resources/design/header.png" border="0">				
				<div id="navigation">
					<?php
						//Navigator displays the menu
						$navigator->display_menu();
					?>
				</div>
			</div>
			<div id="main">
				<div id="left">
					<img src="resources/design/left.png" alt="error loading resources/design/left.png">
				</div>
				<div id="center">
					<?php										
						//navigate to the current page defined in the url (..php?page=x), if added to the navigation (page name)
						//no page in the url displays a default page, no valid page in the url displays a go to default page message with link.
						$navigator->navigate();
					?>
				</div>
				<div id="right">
					<img src="resources/design/right.png" alt="error loading resources/design/right.png">
				</div>
			</div>
			<div id="footer">
				&copy; Copyright 2013 Stefan Berger
			</div>
		</div>
	</body>
</html>