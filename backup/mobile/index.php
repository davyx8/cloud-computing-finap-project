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
				<div>&nbsp;</div>
			</div>
			<div id="divProperties">
				<ul id="ulExplanation">
					<li class="status1">
						<span class="color">&nbsp;</span>
						פנוי
						<span class="count"></span>
					</li>
					<li class="status2">
						<span class="color">&nbsp;</span>
						שמור
						<span class="count"></span>
					</li>
					<li class="status3">
						<span class="color">&nbsp;</span>
						בשימוש
						<span class="count"></span>
					</li>
					<li class="status4">
						<span class="color">&nbsp;</span>
						לא תקין
						<span class="count"></span>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
