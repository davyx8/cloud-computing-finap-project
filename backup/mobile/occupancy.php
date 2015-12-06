<?php
	ini_set("display_errors", 1);

	require_once("../classes/db_connection.php");
	require_once("../classes/lab.php");

        header("Content-Type: application/json");

	$occupancities = array();
	try
	{
		DBConnection::Connect();
		$occupancities = Lab::GetLabsOccupancy();
		DBConnection::Close();
	}
	catch (Exception $ex)
	{
	}

	echo "{";

	$json = "";
	foreach ($occupancities as $o)
	{
		$json .= "\"Lab_" . $o["LabID"] . "\": { \"Used\": " . $o["TotalUsed"] . ", \"Capacity\": " . $o["Capacity"] . "},";
	}
	$json = substr($json, 0, -1);
	$json .= "}";

	echo $json;
?>
