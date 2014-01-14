<?php
	class Order
	{
		public function __construct($language)
		{			
			//manage language texts
			if($language == "DE")
			{
				$this->addlabel = "Hinzufügen";
				$this->editlabel = "Bearbeiten";
				$this->deletelabel = "Löschen";
			}
			else if($language = "EN")
			{
				$this->addlabel = "Add";
				$this->editlabel = "Update";
				$this->deletelabel = "Delete";
			}
		}
		private function display()
		{
		}
	}
?>