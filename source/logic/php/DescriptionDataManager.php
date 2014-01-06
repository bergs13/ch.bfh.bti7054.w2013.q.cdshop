<?php
	class DescriptionDataManager extends mysqli
	{
		function __construct() 
		{
			parent::__construct("localhost", "root", "");
			parent::select_db("cdshop");
		}
		public function get_cdtypes() 
		{
			return $this->query("SELECT * FROM cdtype");
		}
		public function get_cdcategories() 
		{
			return $this->query("SELECT * FROM cdcategory");
		}
		public function get_cdgenres() 
		{
			return $this->query("SELECT * FROM cdgenre");
		}
		public function get_paymentmethods() 
		{
			return $this->query("SELECT * FROM paymentmethod");
		}
		public function get_shippingmethods() 
		{
			return $this->query("SELECT * FROM shippingmethod");
		}
	}
?>