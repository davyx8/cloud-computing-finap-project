<?php
	
	class Computer
	{
		public $ID;
		public $IP;
		public $Name;
		public $Lab;
		public $StatusID;
		public $X1;
		public $Y1;
		public $StudentID;
		
		public function __construct($id, $ip, $name, $lab, $status_id, $x1, $y1, $student_id)
		{
			$this->ID = $id;
			$this->IP = $ip;
			$this->Name = $name;
			$this->Lab = $lab;
			$this->StatusID = $status_id;
			$this->X1 = $x1;
			$this->Y1 = $y1;
			$this->StudentID = $student_id;
		}
		
		/**
		* Gets the computers of the asked lab
		*/
		public static function GetComputersByLab($lab_id)
		{
			$sql = "select * from Computers where LabID = " . $lab_id . " order by X1, Y1;";
			$results = DBConnection::ExecuteSelectQuery($sql);
			
			$computers = self::GetArrayFromDBTable($results);
			return ($computers);
		}

		public static function Order($computer, $user_name)
		{
			$sql = "update Computers
					set
						StudentID = '" . $user_name . "',
						StatusID = 2
					where
						ID = " . $computer . ";";

			DBConnection::ExecuteUpdateQuery($sql);
		}
		
		/**
		* Returns array(Computers) from the results query
		 *
		 * @param array(row) $results The results
		 *
		 * @return array(Computer) The computers, in array
		 */
		private static function GetArrayFromDBTable($results)
		{
			$computers = array();

			foreach ($results as $row)
			{
					$computer = self::GetObjectFromDBRow($row);
					$computers []= $computer;
			}

			return ($computers);
		}

		/**
		 * Returns Computer from the detail in the $row
		 *
		 * @param array $row The row array
		 *
		 * @return Computer The computer
		 */
		private static function GetObjectFromDBRow($row)
		{
			$id = (int)$row["ID"];
			$ip = $row["IP"];
			$name = $row["Name"];
			$lab = new Lab((int)$row["LabID"], null);
			$status_id = (int)$row["StatusID"];
			$x1 = (int)$row["X1"];
			$y1 = (int)$row["Y1"];
			$student_id = $row["StudentID"];
			
			$computer = new Computer($id, $ip, $name, $lab, $status_id, $x1, $y1, $student_id);
			return ($computer);
		}
		
	}
	
?>
