<?php
	$pages = array();
	$defaultPage = "";
	function add_page($pageName, $pageTitle, $isDefault = false, $displayMenu = false)
	{
		global $pages;
		global $defaultPage;
		if(!isset($pages))
		{
			$pages = array($pageName => $pageTitle);
		}
		else
		{
			$temp = array($pageName => $pageTitle);
			$pages = $pages + $temp;
		}
		if($isDefault)
		{
			$defaultPage = $pageName;
		}
		if($displayMenu)
		{
			display_menu();
		}
	}
	function display_menu () 
	{
		global $pages;
		if(isset($pages))
		{
			echo "<ul>";
			foreach($pages as $pageName => $pageTitle)
			{
				echo "<li><div id=\"navButton\"><a href=\"index.php?page=$pageName\" alt=\"$pageTitle\">$pageTitle</a></div></li>";
			}
			echo "</ul>";
		}
	}
	function navigate()
	{
		global $pages;
		global $defaultPage;
		$page = "";
		if(isset($_GET['page']))
		{
			$page = $_GET['page'];
		}
		if (!empty($page))
		{
			if(array_key_exists($page, $pages))
			{
				include(dirname(__FILE__) . '/' . '../' . urlencode($page) . '.php');
			}
			else
			{
				echo 'Seite nicht gefunden. Zurück zur <a href="index.php">Startseite</a>';
			}
		}
		else
		{
			if(!empty($defaultPage))
			{
				//default page
				include(dirname(__FILE__) . '/'. '../' . urlencode($defaultPage). '.php');
			}
			else
			{
				echo 'Default-Seite nicht gefunden.';
			}
		}
	}
?>
				