<?php
	class ShoppingCart
	{
		private $cds = array();
		public function __construct()
		{
		}
		public function add_cd($cd)
		{
			if(!isset($this->cds))
			{
				//initialize
				$this->cds = array($cd->id => $cd);
			}
			else
			{
				//expand
				$temp = array($cd->id => $cd);
				$this->cds = $this->cds + $temp;
			}
		}
		public function remove_cd($id) 
		{
			if(array_key_exists($id, $this->cds))
			{
				unset($this->cds[$id]);
			}
		}
		public function display()
		{
			if(isset($this->cds))
			{
				foreach ($this->cds as $id => $cd)
				{
					echo $cd->title;
					echo "<br/>";
				}
			}
		}
	}
?>
				