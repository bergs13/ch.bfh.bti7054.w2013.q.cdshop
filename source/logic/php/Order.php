<?php
	class Order
	{
		public function __construct($language)
		{			
			//manage language texts
			if($language == "DE")
			{
				$this->addlabel = "Hinzuf�gen";
				$this->editlabel = "Bearbeiten";
				$this->deletelabel = "L�schen";
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