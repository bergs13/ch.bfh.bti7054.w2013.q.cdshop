<?php
	class Navigator
	{
		private $pages = array();
		private $defaultPage = "";
		private $activePage = "";
		private $menulanguages = array("DE", "EN");
		private $menulanguage = "DE";
		public function add_page($pageName, $pageTitleDE, $pageTitleEN, $isDefault = false)
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
		public function set_pages($loggedIn)
		{
			$this->add_page('overview', 'Übersicht', 'Overview', true); //first entry is the default page
			if(!$loggedIn)
			{
				$this->add_page('login', 'Login', 'Login');
			}
			else
			{
				$this->add_page('account', 'Account', 'Account');
				$this->add_page('logout', 'Logout', 'Logout');
				$this->add_page('administration', 'Administration', 'Administration');
			}
			$this->add_page('about', 'Über', 'About');//last entry displays the menu
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
				if(!empty($this->activePage)
					&& $pageName == $this->activePage)
				{
					$class = "active";
				}
				$language = $this->menulanguage;//HTML does not accept '>' and '<'($this->menulanguage)
				echo "<li>";
				echo "<div id=\"navButton\" class=\"$class\">";
				echo "<a href=\"index.php?page=$pageName\" alt=\"$pageTitle[$language]\"><div id=\"navButtonLinkArea\">$pageTitle[$language]</div></a>";
				echo "</div>";
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
		function change_menu_language($new_menulanguage)
		{
			//Set the language
			if(in_array($new_menulanguage, $this->menulanguages))
			{
				$this->menulanguage = $new_menulanguage;
			}
		}
	}
?>
				