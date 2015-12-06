<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/index.css?v=0.0.1" />
		<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="js/jquery.balloon.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
	</head>
	<body>
		<h1>FreeSpot</h1>
		<div id="divMapAndExplanation">
			<div id="divProperties">
				<div id="divSelectLab">
					<h2>אקווריום</h2>
					<select id="slctAquariumID" onchange="loadLab();">
						<option value="2">אקווריום A</option>
						<option value="1" selected="selected">אקווריום C</option>
						<option value="3" disabled="disabled">אקווריום ישן</option>
					</select>
				</div>
				<div>
					<h2>מקרא</h2>
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
			<div id="divMap">
				<h2>תצוגה</h2>
				<div>&nbsp;</div>
			</div>
		</div>
	</body>
</html>