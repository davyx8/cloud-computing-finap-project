<?php
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/index.css?v=0.0.1" />
		<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="../js/jquery.balloon.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<script type="text/javascript">
			var LAB_ID = <?php echo $lab_id; ?>;
		</script>
		<!--meta name="viewport" content="width=1200, user-scalable=0" /-->
	</head>
	<body>
		<div id="divMapAndExplanation">
			<div id="divMap">
				<div class="map">&nbsp;</div>
				<div id="divOccupacity1" class="Occupacity"></div>
				<div id="divOccupacity2" class="Occupacity"></div>
				<div id="divOccupacity3" class="Occupacity"></div>
				<div id="divOccupacity4" class="Occupacity"></div>
			</div>
		</div>
	</body>
</html>
