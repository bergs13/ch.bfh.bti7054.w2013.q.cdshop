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
				<ul>
				<li><div id="navButton"><a href="index.php?page=overview" alt="&Uuml;bersicht">Overview</a></div></li>
				<li><div id="navButton"><a href="index.php?page=login" alt="Login">Login</a></div></li>
				<li><div id="navButton"><a href="index.php?page=administration" alt="Administration">Administration</a></div></li>
				<li><div id="navButton"><a href="index.php?page=about" alt="About">About</a></div></li>
				</ul>
			</div>
			<div id="main">
				<div id="left">
					<img src="resources/left.png" alt="error loading resources/left.png">
				</div>
				<div id="center">
					<?php						$pages = array('overview', 'login', 'administration', 'about');
						$page = "";						if(isset($_GET['page']))						{
							$page = $_GET['page'];						}
						if (!empty($page))
						{
							if(in_array($page,$pages))
							{
								$page = dirname(__FILE__) . '/' . $page . '.php';
								include($page);
							}
						else
						{
							echo 'Seite nicht gefunden. Zurück zur <a href="index.php">Startseite</a>';
						}
						}
						else
						{
							//default page
							include(dirname(__FILE__) . '/overview.php');
						}
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