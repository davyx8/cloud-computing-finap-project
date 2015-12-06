function checkForm()
{
	if ($.trim($("#txtUserName").val()) == "")
	{
		return (false);
	}
	if ($("#txtPassword").val() == "")
	{
		return (false);
	}

	return (true);
}