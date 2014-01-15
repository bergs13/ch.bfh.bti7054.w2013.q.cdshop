<?php
	class Navigator
	{
		private $menupages = array();
		private $pages = array();
		private $defaultPage = "";
		private $activePage = "";
		private $menulanguage;
		public function __construct($language)
		{
			$this->menulanguage = $language;
		}
		public function set_pages($isloggedin, $isadmin)
		{
			//set the menu pages
			$this->set_menu_pages($isloggedin, $isadmin);
			
			//other pages
			$this->add_page('checkout', 'Kasse', 'Checkout', $this->pages);
			$this->add_page('usereditor', 'Benutzer-Editor', 'User-Editor', $this->pages);
			$this->add_page('cdeditor', 'CD-Editor', 'CD-Editor', $this->pages);
			$this->add_page('finish', 'Bestellung übermittelt', 'Order submitted', $this->pages);
		}
		public function update_active_page()
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
		public function display_menu() 
		{
			echo "<ul>";
			foreach($this->menupages as $pageName => $pageTitle)
			{
				$class = "inactive";
				$nohoverdivname = "";
				$lang = $this->menulanguage;
				if(!empty($this->activePage)
					&& $pageName == $this->activePage)
				{
					$class = "active";
					$nohoverdivname = "navButton$pageName";
				}
				echo "<li>";
				echo 	"<div id=\"navButton\" name=\"navButton$pageName\" class=\"$class\"
							onmouseover=\"javascript:set_div_class('navButton$pageName', '$nohoverdivname', 'active')\" 
							onmouseout=\"javascript:set_div_class('navButton$pageName', '$nohoverdivname', 'inactive')\">";
				echo 		"<a href=\"index.php?page=$pageName\" alt=\"$pageTitle[$lang]\"><div id=\"navButtonLinkArea\">$pageTitle[$lang]</div></a>";
				echo 	"</div>";
				echo "</li>";
			}
			echo "</ul>";
		}
		public function navigate()
		{
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
		private function set_menu_pages($isloggedin, $isadmin)
		{
			$this->add_menu_page('overview', 'Übersicht', 'Overview', true); //first entry is the default page
			$this->add_menu_page('about', 'Über', 'About');
			if(!$isloggedin)
			{
				$this->add_menu_page('login', 'Anmelden', 'Login');
			}
			else
			{
				if($isadmin)
				{
					$this->add_menu_page('administration', 'Administration', 'Administration');
				}
				else
				{
					$this->add_menu_page('account', 'Konto ('.$_SESSION["user"].')', 'Account ('.$_SESSION["user"].')');
				}
				$this->add_menu_page('logout', 'Abmelden', 'Logout');
			}
		}
		private function add_page($pageName, $pageTitleDE, $pageTitleEN)
		{
			//replace umlauts with html code
			$pageTitleDE = htmlentities($pageTitleDE); 
			$pageTitleEN = htmlentities($pageTitleEN);
			
			//add page to array
			if(!isset($this->pages))
			{
				//initialize
				$this->pages = array($pageName => array("DE" => $pageTitleDE, "EN" => $pageTitleEN));
				echo "Init";
			}
			else
			{
				//expand
				$temp = array($pageName => array("DE" => $pageTitleDE, "EN" => $pageTitleEN));
				$this->pages = $this->pages + $temp;
			}
		}
		private function add_menu_page($pageName, $pageTitleDE, $pageTitleEN, $isDefault = false)
		{
			//add page to menu pages 
			//replace umlauts with html code
			$pageTitleDE = htmlentities($pageTitleDE); 
			$pageTitleEN = htmlentities($pageTitleEN);
			//add page to array
			if(!isset($this->menupages))
			{
				//initialize
				$this->menupages = array($pageName => array("DE" => $pageTitleDE, "EN" => $pageTitleEN));
				echo "Init";
			}
			else
			{
				//expand
				$temp = array($pageName => array("DE" => $pageTitleDE, "EN" => $pageTitleEN));
				$this->menupages = $this->menupages + $temp;
			}
			
			//add the page to all pages
			$this->add_page($pageName, $pageTitleDE, $pageTitleEN);
			
			//mark the default menu page
			if($isDefault)
			{
				$this->defaultPage = $pageName;
			}
		}
	}
?>
				