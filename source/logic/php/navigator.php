<?php
	class Navigator
	{
		private $pages = array();
		private $defaultPage = "";
		private $activePage = "";
		private $menulanguage;
		public function __construct($language)
		{
			$this->menulanguage = $language;
		}
		public function set_pages($loggedIn)
		{
			$this->add_page('overview', 'Übersicht', 'Overview', true); //first entry is the default page
			$this->add_page('about', 'Über', 'About');//last entry displays the menu
			if(!$loggedIn)
			{
				$this->add_page('login', 'Anmelden', 'Login');
			}
			else
			{
				if($_SESSION["user"] == "admin")
				{
					$this->add_page('administration', 'Administration', 'Administration');
				}
				$this->add_page('account', 'Account ('.$_SESSION["user"].')', 'Account ('.$_SESSION["user"].')');
				$this->add_page('logout', 'Abmelden', 'Logout');
			}
		}
		public function display_menu($updateActivePage = true) 
		{
			if($updateActivePage)
			{
				$this->update_activePage();
			}
			echo "<ul>";
			foreach($this->pages as $pageName => $pageTitle)
			{
				$class = "inactive";
				$lang = $this->menulanguage;
				if(!empty($this->activePage)
					&& $pageName == $this->activePage)
				{
					$class = "active";
				}
				echo "<li>";
				echo 	"<div id=\"navButton\" class=\"$class\">";
				echo 		"<a href=\"index.php?page=$pageName\" alt=\"$pageTitle[$lang]\"><div id=\"navButtonLinkArea\">$pageTitle[$lang]</div></a>";
				echo 	"</div>";
				echo "</li>";
			}
			echo "</ul>";
		}
		public function navigate($updateActivePage = false)
		{
			if($updateActivePage)
			{
				$this->update_activePage();
			}
			if(!empty($this->activePage))
			{
				include(dirname(__FILE__) . '/' . '../../' . urlencode($this->activePage) . '.php');
			}
			else
			{
				if(empty($this->defaultPage))
				{
					echo 'Default-Seite nicht gefunden.';
				}
				else
				{
					echo 'Seite nicht gefunden. Zurück zur <a href="index.php">Startseite</a>';
				}
			}
		}
		private function add_page($pageName, $pageTitleDE, $pageTitleEN, $isDefault = false)
		{
			//replace umlauts with html code
			$pageTitleDE = htmlentities($pageTitleDE); 
			$pageTitleEN = htmlentities($pageTitleEN);
			
			//add page to array
			if(!isset($this->pages))
			{
				//initialize
				$this->pages = array($pageName => array("DE" => $pageTitleDE, "EN" => $pageTitleEN));
			}
			else
			{
				//expand
				$temp = array($pageName => array("DE" => $pageTitleDE, "EN" => $pageTitleEN));
				$this->pages = $this->pages + $temp;
			}
			
			//mark the defaultpage
			if($isDefault)
			{
				$this->defaultPage = $pageName;
			}
		}
		private function update_activePage()
		{
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
				if(array_key_exists($page, $this->pages))
				{
					$this->activePage = $page;
				}
				else 
				{
					$this->activePage = "";
				}
			}
			//error: set the default page if available
			else if(!empty($this->defaultPage))
			{
				$this->activePage = $this->defaultPage;
			}		
		}
	}
?>
				