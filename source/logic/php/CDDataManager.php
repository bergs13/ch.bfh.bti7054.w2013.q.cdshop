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
		public function insert($cdtypeid, $cdcategoryid, $cdgenreid, $interpreter, $title, $year, $price)
		{
			$query = "INSERT cd (cdtypeid, cdcategoryid, cdgenreid, interpreter, title, year, price) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$statement =  $this->prepare($query);
			//Bind the params (ex. "isd", $intvar, $stringvar, $doublevar)
			$statement->bind_param("iiissid", $cdtypeid, $cdcategoryid, $cdgenreid, $interpreter, $title, $year, $price); 			
			$statement->execute();
			$statement->close();
		}
		public function update($cdtypeid, $cdcategoryid, $cdgenreid, $interpreter, $title, $year, $price, $id) 
		{
			$query = "UPDATE cd SET cdtypeid=?, cdcategoryid=?, cdgenreid=?, interpreter=?, title=?, year=?, price=? WHERE id=?";
			$statement =  $this->prepare($query);
			$statement->bind_param("iiissidi", $cdtypeid, $cdcategoryid, $cdgenreid, $interpreter, $title, $year, $price, $id); 			
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
				