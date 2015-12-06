<?php

	class user
	{

		private static $_COOKIE_NAME = "user";

		public $ID;
		public $UserName;
		public $Password;
		public $CsUser;
		public $Warnnings;
		public $ActivationKey;
		public $DateActivated;
		public $DateAdded;

		public function __construct($id, $user_name, $cs_user, $warnnings, $activation_key, $date_activated, $date_added)
		{
			$this->ID = $id;
			$this->UserName = $user_name;
			$this->CsUser = $cs_user;
			$this->Warnnings = $warnnings;
			$this->ActivationKey = $activation_key;
			$this->DateActivated = $date_activated;
			$this->DateAdded = $date_added;
		}

		public static function Load($user_name, $password)
		{
			$user_name = addslashes(stripslashes($user_name));
			$password = md5($password);

			$sql = "select *
					from Users
					where
						(UserName = '" . $user_name . "') and
						(Password = '" . $password . "');";

			$results = DBConnection::ExecuteSelectQuery($sql);

			if (count($results) == 0)
			{
				return (null);
			}
			$row = $results[0];

			if ($row["DateActivated"] == null)
			{
				$date_activated = null;
			}
			else
			{
				$date_activated = new DateTime($row["DateActivated"]);
			}

			$user = new User((int)$row["ID"], $row["UserName"], $row["CsUser"], (int)$row["Warnnings"], $row["ActivationKey"], $date_activated, new DateTime($row["DateAdded"]));

			return ($user);
		}

		public static function IsLoggedIn()
		{
			$id = self::GetCookie_ID();
			return ($id != null);
		}

		public static function GetCookie_ID()
		{
			if (isset($_COOKIE[self::$_COOKIE_NAME]["id"]) == false)
			{
				return (null);
			}

			$id = (int)$_COOKIE[self::$_COOKIE_NAME]["id"];

			if ($id == 0)
			{
				return (null);
			}

			return ($id);
		}

		public static function GetCookie_UserName()
		{
			if (isset($_COOKIE[self::$_COOKIE_NAME]["user_name"]) == false)
			{
				return (null);
			}

			$user_name = $_COOKIE[self::$_COOKIE_NAME]["user_name"];

			if ($user_name == "")
			{
				return (null);
			}

			return ($user_name);
		}

		public function SetCookie()
		{
			setcookie(self::$_COOKIE_NAME . "[id]", $this->ID, 0, "/");
			setcookie(self::$_COOKIE_NAME . "[user_name]", $this->UserName, 0, "/");
		}

		public static function RemoveCookie()
		{
			setcookie(self::$_COOKIE_NAME . "[id]", "", 0, "/");
			setcookie(self::$_COOKIE_NAME . "[user_name]", "", 0, "/");
		}

	}

?>