<?php
	ini_set("display_errors", 1);

	require_once "classes/db_connection.php";
	
	$sql = "select * from Computers;";
	$results = null;
	try
	{
		DBConnection::Connect();
		$results = DBConnection::ExecuteSelectQuery($sql);
	}
	catch (Exception $ex)
	{
	}

	if ($results != null)
	{
		foreach ($results as $row)
		{
			echo $row["ID"] . $row["ComputerName"] . "<br />";
		}
	}

	DBConnection::Close();
?>
done.
