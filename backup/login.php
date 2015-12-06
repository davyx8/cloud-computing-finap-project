<?php
	ini_set("display_errors", 1);

	require_once("classes/db_connection.php");
	require_once("classes/user.php");

	if (isset($_POST["txtUserName"]))
	{
		$user_name = trim($_POST["txtUserName"]);
		$password = $_POST["txtPassword"];

		$user = null;
		try
		{
			DBConnection::Connect();
			$user = User::Load($user_name, $password);
			DBConnection::Close();
		}
		catch (Exception $ex)
		{
		}

		if ($user != null)
		{
			$user->SetCookie();
			header("Location: /huji/");
			exit();
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/login.css?v=0.0.1" />
		<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="js/login.js"></script>
	</head>
	<body>
		<?php
			if (isset($_POST["txtUserName"]))
			{
				?>
				<div class="error">
					לא נמצא משתמש לפי הפרטים שהוזנו.
				</div>
				<?php
			}
		?>
		<form name="frmLogin" method="post" onsubmit="return (checkForm());">
			<?php
				// TODO: Make sucide because of using tables to orgenize the page, instead of divs and css
			?>
			<table>
				<tr>
					<td>
						שם משתמש:
					</td>
					<td>
						<input type="text" name="txtUserName" id="txtUserName" />
					</td>
				</tr>
				<tr>
					<td>
						סיסמה:
					</td>
					<td>
						<input type="password" name="txtPassword" id="txtPassword" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="התחבר" />
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>