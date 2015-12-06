<?php
	if (isset($_POST["txtUserName"]))
	{
		$user_name = trim($_POST["txtUserName"]);
		$password = $_POST["txtPassword"];

		$user = null;
		try
		{
			DBConnection::Connect();
			$$user = User::Load($user_name, $password);
			DBConnection::Close();
		}
		catch (Exception $ex)
		{
		}

		if ($user != null)
		{
			User::SetCookie();
			header("Location: /");
			exit();
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/login.css?v=0.0.1" />
		<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="js/login.js"></script>
	</head>
	<body>
		<form name="frmLogin" method="post">
			<?php
				// TODO: Make sucide because of using tables to orgenize the page, instead of divs and css
			?>
			<table>
				<tr>
					<td>
						שם משתמש:
					</td>
					<td>
						<input type="text" name="txtUserName" />
					</td>
				</tr>
				<tr>
					<td>
						סיסמה:
					</td>
					<td>
						<input type="password" name="txtPassword" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="התחבר" />
					</td>
				</tr>
			</tbale>
		</form>
	</body>
</html>