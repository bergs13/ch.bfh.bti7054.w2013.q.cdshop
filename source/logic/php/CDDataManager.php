<?php
	class CDDataManager extends mysqli
	{
		function __construct() 
		{
			parent::__construct("localhost", "root", "");
			parent::select_db("cdshop");
		}
		public function get_all() 
		{
			return $this->query("SELECT * FROM cd");
		}
		public function get_cd($id)
		{
			$query = "SELECT * FROM cd WHERE id = ?";
			$statement =  $this->prepare($query);
			$statement->bind_param("i", $id); 			
			$statement->execute();
			$result = $statement->get_result()->fetch_object();
			$statement->close();
			return $result;
		}
		public function insert($interpreter, $album, $year)
		{
			$query = "INSERT cd (interpreter, album, year) VALUES (?, ?, ?)";
			$statement =  $this->prepare($query);
			//Bind the params (ex. "isd", $intvar, $stringvar, $doublevar)
			$statement->bind_param("sss", $interpreter, $album, $year); 			
			$statement->execute();
			$statement->close();
		}
		public function update($id, $interpreter, $album, $year) 
		{
			$query = "UPDATE cd SET interpreter=?, album=?, year=? WHERE id=?";
			$statement =  $this->prepare($query);
			$statement->bind_param("ssii", $interpreter, $album, $year, $id); 			
			$statement->execute();
			$statement->close();
		}
		public function delete($id)
		{
			$query = "DELETE FROM cd WHERE id = ?";
			$statement =  $this->prepare($query);
			$statement->bind_param("i", $id); 			
			$statement->execute();
			$statement->close();
		}
	}
?>
				