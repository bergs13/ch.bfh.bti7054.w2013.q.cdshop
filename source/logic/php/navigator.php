<?php
	$pages = array();
	$defaultPage = "";
	$activePage = "";
	$menulanguages = array("DE", "EN");
	$menulanguage = "DE";
	function add_page($pageName, $pageTitleDE, $pageTitleEN, $isDefault = false)
	{
		global $pages;
		global $defaultPage;
		
		//replace umlauts with html code
		$pageTitleDE = htmlentities($pageTitleDE); 
		$pageTitleEN = htmlentities($pageTitleEN);
		
		//add page to array
		if(!isset($pages))
		{
			//initialize
			$pages = array($pageName => array($pageTitleDE, $pageTitleEN));
		}
		else
		{
			//expand
			$temp = array($pageName => array("DE" => $pageTitleDE, "EN" => $pageTitleEN));
			$pages = $pages + $temp;
		}
		
		//mark the defaultpage
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
		
		//get the page with http get
		if(isset($_GET['page']))
		{
			$page = $_GET['page'];
		}
		
		//set the active page
		if (!empty($page))
		{
			//check with array: user could enter any pagename in the adressbar
			if(array_key_exists($page, $pages))
			{
				$activePage = $page;
			}
			else 
			{
				$activePage = "";
			}
		}
		//error: set the default page if available
		else if(!empty($defaultPage))
		{
			$activePage = $defaultPage;
		}		
	}
	function display_menu($updateActivePage = true) 
	{
		global $pages;
		global $activePage;
		global $menulanguage;
		if($updateActivePage)
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
			echo "<li><div id=\"navButton\" class=\"$class\"><a href=\"index.php?page=$pageName\" alt=\"$pageTitle[$menulanguage]\"><div id=\"navButtonLinkArea\">$pageTitle[$menulanguage]</div></a></div></li>";
		}
		echo "</ul>";
	}
	function navigate($updateActivePage = false)
	{
		global $defaultPage;
		global $activePage;
		if($updateActivePage)
		{
			update_activePage();
		}
		if(!empty($activePage))
		{
			include(dirname(__FILE__) . '/' . '../../' . urlencode($activePage) . '.php');
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
	function change_menu_language($new_menulanguage)
	{
		//Set the language
		global $menulanguages;
		global $menulanguage;
		if(in_array($new_menulanguage, $menulanguages))
		{
			$menulanguage = $new_menulanguage;
		}
	}
?>
				