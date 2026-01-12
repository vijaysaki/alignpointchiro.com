<?include("db.php");?>
<?
	if($_POST['action']=="edit"){
	$sql="update tblWebsite SET sTitle='".mysql_real_escape_string($_POST['txtTitle'])."',sContent='".mysql_real_escape_string($_POST['txtContent'])."' where sPageName='".$_GET['page']."'";
	@mysql_query($sql,$link);
	$Message="<b><i><font color='red'>Changes Saved!</font></i></b>";
	}
	$sql="select * from tblWebsite where sPageName='".$_GET['page']."'";
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
<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
</head>
<body style="margin: 0; background-color: #000000;">

<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td style="width: 10px" class="auto-style1"></td>
		<td bgcolor="#444444" width="2"></td>
		<td background="images/bottombg.gif" class="LeftLink" style="width: 320px" align="right" valign="top">
		<br />
		<table border="0" width="100%" cellspacing="4" cellpadding="4" class="AdminTitle">
			<tr>
				<td>
				<p align="right">Manage <?echo $_SESSION['CompanyName'];?></td>
			</tr>
		</table>
			<br />
			<?echo date("l, F d, Y h:i" ,time());?>&nbsp; <br />
		<br />
		<a target="_blank" class="LeftLink" href="http://www.calaispark.com">View the Site</a> | 
		<a class="LeftLink" href="sign-out.php">Sign Out&nbsp; </a> <br />
		<br />
		<br>
		&nbsp;<p><a href="dashboard.php">
		<img border="0" src="images/link-dashboard.jpg" width="200" height="33" alt="Dashboard"></a></p>
		<p>
		<a href="products.php">
		<img border="0" src="images/link-manage-products.jpg" width="200" height="33" alt="Manage Products"></a></p>
		<p><a href="services.php">
		<img border="0" src="images/link-manage-services.jpg" width="200" height="33" alt="Manage Services"></a><br>
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
		<img border="0" src="images/active-link-website-pages.jpg" width="200" height="33" alt="Website Pages"></a></p>
		<p><a href="photo-gallery.php">
		<img border="0" src="images/link-photo-gallery.jpg" width="200" height="33" alt="Photo Gallery"></a></p>
		<p><a href="press.php">
		<img border="0" src="images/link-press.jpg" width="200" height="33" alt="Events"></a></p>
		<p>&nbsp;</p>
		<p>
		&nbsp;</p>
		<p>&nbsp;</p>
		<p>
		<br />
		</td>
		<td bgcolor="white" style="width: 20px"></td>
		<td bgcolor="white" valign="top" class="ContentText">
		<h2><br /><?echo $_SESSION['CompanyName'];?></h2>
		<p><b>Manage Pages</b></p>
		<p><?echo $Message;?></p>
		<p><a href="page.php?page=index.php">Home Page</a> |
		<a href="page.php?page=products.php">Products</a> |
		<a href="page.php?page=services.php">Services</a> |
		<a href="page.php?page=applications.php">Applications</a> |
		<a href="page.php?page=about-us.php">About Us</a> |
		<a href="page.php?page=investors.php">Investor Relations</a> |
		<a href="page.php?page=careers.php">Careers</a> | </p>
		<form name="frm" action="page.php?page=<?echo $_GET['page'];?>" method=post>
			<input type=hidden name="action" value="edit">
			<table border="1" width="750" style="border-collapse: collapse" bordercolor="#007AB6" class="ContentText" cellspacing="4" cellpadding="4">
				<tr>
					<td width="100" bgcolor="#007AB6" valign="top">
					<font color="#FFFFFF">Page Title</font></td>
					<td><input type="text" name="txtTitle" size="75" value="<?echo $row['sTitle'];?>"></td>
				</tr>
				<tr>
					<td width="100" bgcolor="#007AB6" valign="top">
					<font color="#FFFFFF">Content</font></td>
					<td><textarea id="textarea2" name="txtContent"><?echo $row['sContent'];?></textarea></p>		<p>
					<script language="javascript1.2">
					  generate_wysiwyg('textarea2');
					</script>
					</td>
				</tr>
				<tr>
					<td width="100" bgcolor="#007AB6" valign="top">
					&nbsp;</td>
					<td>
					<input border="0" src="images/submit-button.png" name="I1" width="76" height="33" type="image"></td>
				</tr>
			</table>
		</form>
		</td>
	</tr>
	<tr>
		<td style="width: 10px; height: 2px;"></td>
		<td bgcolor="#444444" width="2" style="height: 2px"></td>
		<td bgcolor="444444" class="LeftLink" style="height: 2px;" align="right" valign="top" colspan="3"></td>
	</tr>
</table>
</body>

</html>