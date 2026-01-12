<?
	session_start();
	$_SESSION['CompanyName']="Align Point Chrio";
	if($_POST['action']=="login")
	{
		if($_POST['txtUserName']=="admin" && $_POST['txtPassword']=="password")
		{
					$_SESSION['loggedin']="1";
					header("Location: dashboard.php");
		}
		else
		{
			$Error="<font color='red'><b>Incorrect Username or Password</b></font>";
		}	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Manage Your Business - <?echo $_SESSION['CompanyName'];?></title>
<style type="text/css">
.auto-style1 {
	text-align: center;
	background-image: url('images/topbg.gif');
}
.auto-style2 {
	background-color: #444444;
}
.auto-style3 {
	text-align: center;
}
.myButton {
    background:url(images/admin-sign-in.png) no-repeat;
    cursor:pointer;
    width: 76px;
    height: 33px;
    border: none;
}
</style>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body style="margin: 0; background-image: url('images/bottombg.gif');">

<table cellpadding="0" cellspacing="0" style="width: 100%; height: 200px">
	<tr>
		<td class="AdminTitle" valign="top">
		<p align="center"><br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		Manage <?echo $_SESSION['CompanyName'];?></td>
	</tr>
	<tr>
	<td class="auto-style2" style="height: 2px"></td>
	</tr>
</table>

<p>&nbsp;</p>
<table align="center" style="width: 310px">
	<tr>
		<td class="auto-style3">
		<img alt="Enter Your Login Information" height="39" src="images/login-title.png" width="308" /></td>
	</tr>
	<tr>
		<td style="height: 15px"></td>
	</tr>
	<tr>
		<td style="height: 15px"><?echo $Error;?></td>
	</tr>
	</table>
			<form method=post action="index.php">
			<input type="hidden" name="action" value="login">
		<table align="center" style="width: 250px" class="AdminTitle" >
			<tr>
				<td>Username&nbsp;</td>
				<td style="width: 50px">
				<input type="text" class="rounded" name="txtUserName" size="20"></td>
			</tr>
			<tr>
				<td colspan="2" height="4"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td style="width: 51px">
				<input type="password" class="rounded" name="txtPassword" size="20"></td>
			</tr>
			<tr>
				<td colspan="2" style="height: 4px"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style="width: 51px" align="right"><input class="myButton" type="submit" value=""></td>
			</tr>
		</table>
</form>
</body>

</html>
