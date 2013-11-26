<?php
	class CDDataManager extends mysqli
	{
		function __construct() 
		{
			parent::__construct("localhost", "root", "");
			parent::select_db("cdshop");
		}
		public function get_all($ordered = false, $descending = false) 
		{
			return $this->query("SELECT * FROM cd");
		}
		public function insert($interpreter, $album, $year)
		{
			$this->query("INSERT cd (interpreter, album, year) VALUES ('$interpreter','$album','$year')");
		}
		public function update($id, $interpreter, $album, $year) 
		{
			$this->query("UPDATE cd SET interpreter='$interpreter', album='$album', year='$year' WHERE id=$id");
		}
		public function delete($id)
		{
			$this->query("DELETE FROM cd WHERE id = $id");
		}
	}
?>
				