<?php
	class UserDataManager extends mysqli
	{
		function __construct() 
		{
			parent::__construct("localhost", "root", "");
			parent::select_db("cdshop");
		}
		public function get_all($ordered = false, $descending = false) 
		{
			return $this->query("SELECT * FROM user");
		}
		public function insert($username, $password)
		{
			$this->query("INSERT user (username, password) VALUES ('$username','$password')");
		}
		public function update($id, $username, $password) 
		{
			$this->query("UPDATE user SET username='$username', password='$password' WHERE id=$id");
		}
		public function delete($id)
		{
			$this->query("DELETE FROM user WHERE id = $id");
		}
	}
?>
				