<?php
	ini_set("display_errors", 1);

	if (isset($_GET["lab"]) == false)
	{
		echo "Bad input 1";
		exit();
	}
	$lab_id = $_GET["lab"];
	if (preg_match("/^\\d+$/", $lab_id) == false)
        {
                echo "Bad input 2";
                exit();
        }
	$lab_id = (int)$lab_id;

	require_once("../classes/db_connection.php");
	require_once("../classes/lab.php");
	require_once("../classes/computer.php");

	$computers = array();
	try
	{
		DBConnection::Connect();
		$computers = Computer::GetComputersByLab($lab_id);
		DBConnection::Close();
	}
	catch (Exception $ex)
	{
	}

	$st = "";
	foreach ($computers as $computer)
	{
		$st .= "{
				\"id\": " . $computer->ID . ",
				\"ip\": \"" . $computer->IP . "\",
				\"name\": \"" . $computer->Name . "\",
				\"studentID\": " . ($computer->StudentID == null ? "null" : "\"" . $computer->StudentID . "\"") . ",
				\"x1\": " . $computer->X1 . ",
                                \"y1\": " . $computer->Y1 . ",
				\"statusID\": " . $computer->StatusID . "
			},";
	}
	$st = str_replace("\t", "", substr($st, 0, -1));

	header("Content-Type: application/json");
        //header("Content-Type: text/plain");

	echo "[" . $st . "]";
?>
