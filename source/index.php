<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Cookies -->
<?php 
	//Language change via link
	if ( !empty($_GET['language']) ) 
	{
		$_COOKIE['language'] = $_GET['language'];
		setcookie('language', $_COOKIE['language']);
	} 
?>
<html>
	<head>
		<title>CD Shop</title>
		<meta name="description" content="Projekt CD Shop für das Modul Web programming (BTI7054)">
		<meta name="author" content="bergs13">
		<link rel="stylesheet" href="styles/design.css" type="text/css">
	</head>
	<body>
		<?php		
			//General
			//Autoload for all used classes
			function __autoload($class_name) 
			{
				require_once("logic/php/".$class_name.".php");
			}
			//Get the language for the content
			$languagemanager = new LanguageManager;
			
			//Authenticator handles login if needed (Post-Check)
			$authenticator = new Authenticator($languagemanager->language);
			$authenticator->handle_login();
			//Authenticator manages menu pages of navigator
			$navigator = new Navigator($languagemanager->language);
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
					<div id="shoppingcart">
						<?php
							$shoppingcart;
							//get cart from session or create if not exists
							if (isset($_SESSION["shoppingcart"]))
							{
								$shoppingcart = $_SESSION["shoppingcart"];
							}
							else
							{
								$shoppingcart = new ShoppingCart;
							}
							//add/remove items
							$shoppingcart->handle_post();
							//save after add/remove into session
							$_SESSION["shoppingcart"] = $shoppingcart;
							//display the content
							$shoppingcart->display($languagemanager->language);
						?>
					</div>
					<!--<img src=\"resources/design/right.png\" alt=\"error loading resources/design/right.png\">-->
				</div>
			</div>
			<div id="footer">
				<div id="copyright">
					&copy; Copyright 2013 Stefan Berger 
				</div>
				<div id="languageNavigation">
					<?php
						$languagemanager->display_languagemenu();
					?>
				</div>
			</div>
		</div>
	</body>
</html>