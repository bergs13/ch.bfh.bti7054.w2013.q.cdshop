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
				<img src="resources/design/header.png" alt="error loading resources/design/header.png" border="0">	
<a href="index.php?language=DE">DE</a>
					<a href="index.php?language=EN">EN</a>				
				<div id="navigation">
					<?php
						require_once("logic/php/navigator.php");
						
						//get the page with http get
						$l = "";
						if(isset($_GET['language']))
						{
							$l = $_GET['language'];
						}
						
						//change language
						if (!empty($l))
						{
							change_menu_language($l);
						}
						
						
						add_page('overview', 'Übersicht', 'Overview', true); //first entry is the default page
						add_page('login', 'Login', 'Login');
						add_page('account', 'Account', 'Account');
						add_page('administration', 'Administration', 'Administration');
						add_page('about', 'Über', 'About');//last entry displays the menu
						display_menu();
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
						navigate();
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