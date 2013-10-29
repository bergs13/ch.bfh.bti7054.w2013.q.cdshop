<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>CD Shop</title>
		<meta name="description" content="Projekt CD Shop für das Modul Web programming (BTI7054)">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/design.css" type="text/css">
	</head>
	<body>
		<div id="site">
			<div id="header">
				<img src="resources/header.png" alt="error loading resources/header.png" border="0">		
				<div id="navigation">
					<?php
						require_once("logic/navigator.php");
						add_page('overview', 'Overview', true); //first entry is the default page
						add_page('login', 'Login');
						add_page('administration', 'Administration');
						add_page('about', 'About');//last entry displays the menu
						display_menu();
					?>
				</div>
			</div>
			<div id="main">
				<div id="left">
					<img src="resources/left.png" alt="error loading resources/left.png">
				</div>
				<div id="center">
					<?php
						//navigate to the current page defined in the url (..php?page=x), if added to the navigation (page name)
						//no page in the url displays a default page, no valid page in the url displays a go to default page message with link.
						navigate();
					?>
				</div>
				<div id="right">
					<img src="resources/right.png" alt="error loading resources/right.png">
				</div>
			</div>
			<div id="footer">
				&copy; Copyright 2013 Stefan Berger
			</div>
		</div>
	</body>
</html>