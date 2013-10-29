<?php
	$pages = array();
	$defaultPage = "";
	$activePage = "";
	function add_page($pageName, $pageTitle, $isDefault = false)
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
	}
	function update_activePage()
	{
		global $pages;
		global $defaultPage;
		global $activePage;
		$page = "";
		if(isset($_GET['page']))
		{
			$page = $_GET['page'];
		}
		//check with array: user could enter any pagename in the adressbar
		if (!empty($page))
		{
			if(array_key_exists($page, $pages))
			{
				$activePage = $page;
			}
			else 
			{
				$activePage = "";
			}
		}
		else if(!empty($defaultPage))
		{
			$activePage = $defaultPage;
		}		
	}
	function display_menu($update_activePage = true) 
	{
		global $pages;
		global $activePage;
		if($update_activePage)
		{
			update_activePage();
		}
		echo "<ul>";
		foreach($pages as $pageName => $pageTitle)
		{
			$class = "inactive";
			if(!empty($activePage)
				&& $pageName == $activePage)
			{
				$class = "active";
			}
			echo "<li><div id=\"navButton\" class=\"$class\"><a href=\"index.php?page=$pageName\" alt=\"$pageTitle\">$pageTitle</a></div></li>";
		}
		echo "</ul>";
	}
	function navigate($update_activePage = false)
	{
		global $defaultPage;
		global $activePage;
		if($update_activePage)
		{
			update_activePage();
		}
		if(!empty($activePage))
		{
			include(dirname(__FILE__) . '/' . '../' . urlencode($activePage) . '.php');
		}
		else
		{
			if(empty($defaultPage))
			{
				echo 'Default-Seite nicht gefunden.';
			}
			else
			{
				echo 'Seite nicht gefunden. Zurück zur <a href="index.php">Startseite</a>';
			}
		}
	}
?>
				