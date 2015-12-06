<?php
	ini_set("display_errors", 1);

	require_once("classes/user.php");

	if (isset($_GET["logout"]))
	{
		User::RemoveCookie();
		header("Location: /huji/");
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/index.css?v=0.0.1" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> <!-- for Open-Sans font -->
		<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="js/jquery.balloon.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
	</head>
	<body>
		<h1>
			<img src="pics/logo.png" alt="FreeSpot" />
		</h1>
		<div id="divMapAndExplanation">
			<div id="divProperties">
				<div id="divSelectLab">
					<select id="slctAquariumID" onchange="loadLab();">
						<option value="2" selected="selected">Aquarium A</option>
						<option value="1">Aquarium C</option>
						<option value="3" disabled="disabled">Old Aquarium</option>
					</select>
				</div>
				<div id="divNotRegistered">
					Login is required in order to reserve a computer.
					<br />
					<input type="button" onclick="login();" value="Connect!" />
				</div>
				<div id="divRegister">
					Hello
					<span id="spnUserName"></span>!
					<br />
					Reserved
					<span id="spnRegisterCount">0</span>
					Computers for reservation.
					<br />
					<input type="button" id="btnReserve" value="Reserve!" onclick="reserve();" disabled="disabled" />
					<input type="button" value="Disconnect" onclick="document.location.href = '/huji/index.php?logout=1';" />
				</div>
			</div>
			<div id="divMap">
				<div class="map">&nbsp;</div>
				<div id="divOccupacity1" class="Occupacity"></div>
				<div id="divOccupacity2" class="Occupacity"></div>
				<div id="divOccupacity3" class="Occupacity"></div>
				<div id="divOccupacity4" class="Occupacity"></div>
			</div>
		</div>
		<iframe id="ifrmPages" src="about:blank"></iframe>
	</body>
</html>
