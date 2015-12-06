<?php
	
	class Lab
	{
		public $ID;
		public $Name;
		
		public function __construct($id, $name)
		{
			$this->ID = $id;
			$this->Name = $name;
		}

		public static function GetLabsOccupancy()
		{
			$sql = "select
					Labs.ID as LabID,
					Labs.Capacity,
					(
						select count(Computers.LabID)
						from Computers
						where
							(Computers.LabID = Labs.ID) and
							((Computers.StatusID = 2) or (Computers.StatusID = 3))
					) as TotalUsed
				from Labs;";

			$results = DBConnection::ExecuteSelectQuery($sql);

			return ($results);
		}
		
	}
	
?>
