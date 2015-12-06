<?php
	ini_set("display_errors", 1);

	require_once("classes/db_connection.php");
	require_once("classes/computer.php");
	require_once("classes/user.php");

	if (isset($_POST["txtComputer2"]))
	{

		// TODO: add try-catch
		DBConnection::Connect();

		$user1 = User::GetCookie_UserName();
		$computer1 = $_POST["txtComputer1"];
		Computer::Order($computer1, $user1);

		$user2 = $_POST["txtUser2"];
		$computer2 = $_POST["txtComputer2"];

		$user3 = null;

		if ($user2 != $user1)
		{
			Computer::Order($computer2, $user2);
		}

		if (isset($_POST["txtUser3"]))
		{
			$user3 = $_POST["txtUser3"];
			if (($user3 != $user1) && ($user3 != $user2))
			{
				$computer3 = $_POST["txtComputer3"];

				// TODO: add try-catch
				Computer::Order($computer3, $user3);
			}
		}

		DBConnection::Close();

		// Yes, not valid html, but browsers can handle it, and we are out of time :(
		?>
			<div class="ordered">
				<?php
					if (($user1 == $user2) || ($user1 == $user3))
					{
						echo "One of your friends is... you...<br />You can't be so lonely... :-(";
					}
					else
					{
						if ($user3 == $user2)
						{
							echo "Friend 2 can't be equal to Friend 3. You need more friends, or use less spots :-)";
						}
						else
						{
							echo "Your order is reserved!<br />Happy programming!";
						}
					}
				?>
				<br />
				<br />
				<input type="button" value="Close" onclick="window.parent.location.href = window.parent.location.href" />
			</div>
		<?php
	}
	else
	{
		// TODO: Never assume valid input. Fix this
		$computers = explode(",", $_GET["computers"]);
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/order.css?v=0.0.1" />
		<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
		<!--script type="text/javascript" src="js/order.js"></script-->
	</head>
	<body>
		<?php
			if (isset($_POST["txtComputer2"]))
			{

			}
			else
			{
				if (count($computers) == 1)
				{
					$user_name = User::GetCookie_UserName();

					DBConnection::Connect();
					Computer::Order($computers[0], $user_name);
					DBConnection::Close();

					// Yes, not valid html, but browsers can handle it, and we are out of time :(
					?>
						<div class="ordered">
							Your order is reserved!
							<br />
							Happy programming!
							<br />
							<br />
							<input type="button" value="Close" onclick="window.parent.location.href = window.parent.location.href;" />
						</div>
					<?php
				}
				else
				{
					?>
						<form name="frm" method="post">
							<input type="hidden" name="txtComputer1" value="<?php echo $computers[0]; ?>" />
							<table>
								<tr>
									<td>
										User 2:
									</td>
									<td>
										<input type="text" name="txtUser2" />
										<input type="hidden" name="txtComputer2" value="<?php echo $computers[1]; ?>" />
									</td>
								</tr>
								<?php
									if (count($computers) == 3)
									{
										?>
											<tr>
												<td>
													User 3:
												</td>
												<td>
													<input type="text" name="txtUser3" />
													<input type="hidden" name="txtComputer3" value="<?php echo $computers[2]; ?>" />
												</td>
											</tr>
										<?php
									}
								?>
								<tr>
									<td>
										<input type="submit" value="Order!" />
									</td>
									<td>
										<input type="button" value="Cancel" onclick="window.parent.closeMiniPage();" />
									</td>
								</tr>
							</table>
						</form>
					<?php
				}
			}
		?>
	</body>
</html>
