<?php
	class UserDataManager extends mysqli
	{
		function __construct() 
		{
			parent::__construct("localhost", "root", "");
			parent::select_db("cdshop");
		}
		public function get_all() 
		{
			return $this->query("SELECT * FROM user");
		}
		public function get_user($id)
		{
			$query = "SELECT * FROM user WHERE id = ?";
			$statement =  $this->prepare($query);
			$statement->bind_param("i", $id); 			
			$statement->execute();
			$result = $statement->get_result()->fetch_object();
			$statement->close();
			return $result;
		}
		public function insert($username, $password)
		{
			$query = "INSERT user (username, password) VALUES (?, ?)";
			$statement =  $this->prepare($query);
			//Bind the params (ex. "isd", $intvar, $stringvar, $doublevar)
			$statement->bind_param("ss", $username, $password); 			
			$statement->execute();
			$statement->close();
		}
		public function update($username, $password, $id) 
		{			
			$query = "UPDATE user SET username=?, password=? WHERE id=?";
			$statement =  $this->prepare($query);
			//Bind the params (ex. "isd", $intvar, $stringvar, $doublevar)
			$statement->bind_param("ssi", $username, $password, $id); 			
			$result = $statement->execute();
			$statement->close();			
		}
		public function delete($id)
		{
			$query = "DELETE FROM user WHERE id = ?";
			$statement =  $this->prepare($query);
			//Bind the params (ex. "isd", $intvar, $stringvar, $doublevar)
			$statement->bind_param("i", $id); 			
			$statement->execute();
			$statement->close();
		}
	}
?>
				