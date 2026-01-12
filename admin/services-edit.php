<?include("db.php");
	if($_POST['action']=="edit"){
	$sql="update tblServices SET sName='".mysql_real_escape_string($_POST['txtTitle'])."',sContent='".mysql_real_escape_string($_POST['txtContent'])."',
	sName_ES='".mysql_real_escape_string($_POST['txtTitle_ES'])."',sContent_ES='".mysql_real_escape_string($_POST['txtContent_ES'])."', sName_PT='".mysql_real_escape_string($_POST['txtTitle_PT'])."',
	sContent_PT='".mysql_real_escape_string($_POST['txtContent_PT'])."' where iID='".$_GET['id']."'";
	@mysql_query($sql,$link);
	$Message="<b><i><font color='red'>Changes Saved!</font></i></b>";
	}
	$sql="select * from tblServices where iID=".$_GET['id'];
	$result=@mysql_query($sql,$link);
	$row=mysql_fetch_array($result);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Manage Your Property - <?echo $_SESSION['CompanyName'];?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.auto-style1 {
	background-image: url('images/topbg.gif');
}
.auto-style2 {
	border-collapse: collapse;
	border: 1px solid #007AB6;
}
.auto-style3 {
	text-align: center;
	border: 1px solid #007AB6;
}
</style>
<script language="JavaScript" type="text/javascript" src="wysiwyg1.js"></script>
</head>
<body style="margin: 0; background-color: #000000;">

<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td style="width: 10px" class="auto-style1"></td>
		<td bgcolor="#444444" width="2"></td>
		<td background="images/bottombg.gif" class="LeftLink" style="width: 320px" align="right" valign="top">
		<br />
		<center>
		<table border="0" width="100%" cellspacing="4" cellpadding="4" class="AdminTitle">
			<tr>
				<td>
				<p align="right">Manage <?echo $_SESSION['CompanyName'];?></td>
			</tr>
		</table>
		</center>
			<br />
			<?echo date("l, F d, Y h:i" ,time());?>&nbsp; <br />
		<br />
		<a target="_blank" class="LeftLink" href="http://www.calaispark.com">View the Site</a> | 
		<a class="LeftLink" href="sign-out.php">Sign Out&nbsp; </a> <br />
		&nbsp;<p><a href="dashboard.php">
		<img border="0" src="images/link-dashboard.jpg" width="200" height="33" alt="Dashboard"></a></p>
		<p>
		<a href="products.php">
		<img border="0" src="images/link-manage-products.jpg" width="200" height="33" alt="Manage Products"></a></p>
		<p>
		<a href="services.php">
		<img border="0" src="images/active-link-manage-services.jpg" width="200" height="33" alt="Manage Services"></a><br>
		<br>
		<a href="resources.php">
		<img border="0" src="images/link-manage-resources.jpg" width="197" height="33" alt="Manage Resources"></a><br>
		<br>
		<a href="about-us.php">
		<img border="0" src="images/link-manage-about-us.jpg" width="197" height="33" alt="Manage About Us"></a></p>
		<p>
		<a href="staff.php">
		<img border="0" src="images/link-manage-staff.jpg" width="200" height="33" alt="Manage Staff"></a></p>
		<p>
		<a href="page.php?page=index.php">
		<img border="0" src="images/link-website-pages.jpg" width="200" height="33" alt="Website Pages"></a></p>
		<p><a href="photo-gallery.php">
		<img border="0" src="images/link-photo-gallery.jpg" width="200" height="33" alt="Photo Gallery"></a></p>
		<p><a href="press.php">
		<img border="0" src="images/link-press.jpg" width="200" height="33" alt="Events"></a></p>
		<p>
		<br />
		</td>
		<td bgcolor="white" style="width: 20px"></td>
		<td bgcolor="white" valign="top" class="ContentText">
		<h2><br /><?echo $_SESSION['CompanyName'];?></h2>
		<p><b>Manage Services</b></p>
		<p>Edit Services</p>
		<p><?echo $Message;?></p>
		<form action="services-edit.php?id=<?echo $_GET['id'];?>" method=post>
		<input type=hidden name="action" value="edit">
		<table border="0" width="432" cellspacing="4" cellpadding="4" class="ContentText">
			<tr>
				<td width="111" valign="top"><b>English</b></td>
				<td width="293">&nbsp;</td>
			</tr>
			<tr>
				<td width="111" valign="top">Service Name</td>
				<td width="293"><input type="text" name="txtTitle" size="43" value="<?echo $row['sName']?>"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Information</td>
				<td width="293"><textarea id="textarea1" rows="9" name="txtContent" cols="34"><?echo $row['sContent']?></textarea>
				<script language="javascript1.2">generate_wysiwyg('textarea1');	</script>
				</td>
			</tr>
			<tr>
				<td width="111" valign="top"><b>Spanish</b></td>
				<td width="293" align="right">
				&nbsp;</td>
			</tr>
			<tr>
				<td width="111" valign="top">Service Name</td>
				<td width="293">
				<input type="text" name="txtTitle_ES" size="43" value="<?echo $row['sName_ES']?>"></td>
			</tr>
			<tr>
				<td width="111" valign="top">&nbsp;</td>
				<td width="293" align="right"><textarea id="textarea2" rows="9" name="txtContent_ES" cols="34"><?echo $row['sContent_ES']?></textarea>
				<script language="javascript1.2">generate_wysiwyg('textarea2');	</script></td>
			</tr>
			<tr>
				<td width="111" valign="top"><b>Portuguese</b></td>
				<td width="293" align="right">
				&nbsp;</td>
			</tr>
			<tr>
				<td width="111" valign="top">Service Name</td>
				<td width="293">
				<input type="text" name="txtTitle_PT" size="43" value="<?echo $row['sName_PT']?>"></td>
			</tr>
			<tr>
				<td width="111" valign="top">&nbsp;</td>
				<td width="293" align="right">
				<textarea id="textarea3" rows="9" name="txtContent_PT" cols="34"><?echo $row['sContent_PT']?></textarea>
				<script language="javascript1.2">generate_wysiwyg('textarea3');	</script>
				&nbsp;</td>
			</tr>
			<tr>
				<td width="111" valign="top">&nbsp;</td>
				<td width="293" align="right">
				<input type="submit" value="Submit" name="B1"></td>
			</tr>
		</table>
		</form>
		Edit/Update Services<br>
		<table border="0" width="500" class="ContentText" cellspacing="4" cellpadding="4">
			<tr>
				<td width="305"><b>Title</b></td>
				<td width="50"></td>
				<td width="50"></td>
			</tr>
		
	<?while($row=mysql_fetch_array($result)){?>
	<tr>
		<td style="width: 10px; height: 2px;"><?echo $row['sName'];?></td>
		<td bgcolor="#444444" width="2" style="height: 2px"><a href="services-edit.php?id=<?echo $row['iID'];?>">Edit</a></td>
		<td bgcolor="444444" class="LeftLink" style="height: 2px;" align="right" valign="top" colspan="3"><a href="services.php?action=delete&id=<?echo $row['iID'];?>">Delete</a></td>
	</tr>
	<?}?>
	</table>
	</td>
	</tr>
</table>
</body>

</html>
