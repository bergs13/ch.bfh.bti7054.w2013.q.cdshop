<?php
	class LanguageManager
	{
		public $language;	
		private $languages = array("DE","EN");
		private $defaultlanguage = "DE";
		private $languageTitles = array("DE" => array("DE" => "Deutsch", "EN" => "Englisch"), "EN" => array("DE" => "German", "EN" => "English"));
		public function __construct()
		{
			$this->update_language();
		}
		private function update_language()
		{
			$l;
			if(isset($_COOKIE["language"])) 
			{
				$l = $_COOKIE["language"];
			}
			else
			{
				$l = $this->defaultlanguage;
			}
			
			//Set the language
			if(in_array($l, $this->languages))
			{
				$this->language = $l;
			}
		}
		public function display_languagemenu() 
		{
			//Language text and class (div class) selection => HTML does not accept '>' and '<'($this->*)
			$languageDE = $this->languageTitles[$this->language]["DE"];
			$classDE = $this->language == "DE" ? "active" : "inactive";
			$languageEN = $this->languageTitles[$this->language]["EN"];
			$classEN = $this->language == "EN" ? "active" : "inactive";
			
			//Generate output (divs defined in css)
			echo "<ul>";
			echo 	"<li>";
			echo 			"<ul>";
			echo 				"<li>";
			echo 					"<div id=\"languageButton\" class=\"$classDE\">";
			echo 						"<a href=\"index.php?language=DE\" alt=\"$languageDE\"><div id=\"languageButtonLinkArea\">$languageDE</div></a>";
			echo 					"</div>";
			echo 				"</li>";
			echo				"<li>";
			echo 					"<div id=\"languageButton\" class=\"$classEN\">";
			echo 						"<a href=\"index.php?language=EN\" alt=\"$languageEN\"><div id=\"languageButtonLinkArea\">$languageEN</div></a>";
			echo 					"</div>";
			echo				"</li>";
			echo			"</ul>";
			echo 	"</li>";
			echo "</ul>";
		}
	}
?>
				