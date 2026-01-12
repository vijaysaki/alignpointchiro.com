<?include("db.php");


		if($_GET['action']=="order")
		{
			$iCount = (int)$_POST['txtTotalCount'];
			for ($i=1;$i<=$iCount;$i++)
			{
				$name="txtid".$i;
				$order="txtOrder".$i;
				$sql="update tblProducts SET iOrder=".$_POST[$order]." where iID=".$_POST[$name];
				$result=@mysql_query($sql,$link);
			}
		}









	if($_GET['action']=="delete"){
		$sql="delete from tblProducts where iID=".$_GET['pid'];
		$result=@mysql_query($sql,$link);
		$Message="<b><i><font color='red'>Item Deleted!</font></i></b>";
	}
	if($_GET['action']=="add"){
	$sql="insert into tblProducts (iCatID,sName,sContent)values(".$_GET['id'].",'".mysql_real_escape_string($_POST['txtTitle'])."','".mysql_real_escape_string($_POST['txtContent'])."')";
	@mysql_query($sql,$link);
	$Message="<b><i><font color='red'>Changes Saved!</font></i></b>";
	}
	$sql="select * from tblProducts where iCatID=".$_GET['id']." order by iOrder";
	$result=@mysql_query($sql,$link);
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
		<img border="0" src="images/active-link-manage-products.jpg" width="200" height="33" alt="Manage Products"></a></p>
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
		<p><b>Manage Product for [<?echo $_GET['name'];?>]</b></p>
		<p>Add Product</p>
		<p><?echo $Message;?></p>
		<form action="products-items.php?id=<?echo $_GET['id'];?>&name=<?echo $_GET['name'];?>&action=add" method=post>
		<table border="0" width="432" cellspacing="4" cellpadding="4" class="ContentText">
			<tr>
				<td width="111" valign="top">Product Name</td>
				<td width="293"><input type="text" name="txtTitle" size="43"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Information</td>
				<td width="293"><textarea id="textarea1" rows="9" name="txtContent" cols="34"></textarea>
				<script language="javascript1.2">generate_wysiwyg('textarea1');	</script>
				</td>
			</tr>
			<tr>
				<td width="111" valign="top">&nbsp;</td>
				<td width="293" align="right">
				<input type="submit" value="Submit" name="B1"></td>
			</tr>
		</table>
		</form>
		Edit/Update Products<br>
		<form  method=post action="products-items.php?id=<?echo $_GET['id'];?>&name=<?echo $_GET['name'];?>&action=order">
		<input type=hidden name="action" value="order">
		<table border="0" width="500" class="ContentText" cellspacing="4" cellpadding="4">
			<tr>
				<td width="305"><b>Title</b></td>
				<td width="50"></td>
				<td width="50"></td>
			</tr>
		
	<?
	$i=0;
	while($row=mysql_fetch_array($result)){$i=$i+1;?>
	<tr>
		<td style="width: 10px; height: 2px;"><a href="sub-products.php?pid=<?echo $row['iID'];?>&id=<?echo $_GET['id']?>&name=<?echo $_GET['name'];?> -> <?echo $row['sName']?>"><?echo $row['sName'];?></a></td>
		<td bgcolor="#444444" width="2" style="height: 2px"><a href="products-items-edit.php?pid=<?echo $row['iID'];?>&id=<?echo $_GET['id']?>&name=<?echo $_GET['name'];?>">Edit</a></td>
		<td bgcolor="444444" class="LeftLink" style="height: 2px;" align="right" valign="top" colspan="3"><a href="products-items.php?action=delete&pid=<?echo $row['iID'];?>&id=<?echo $_GET['id']?>&name=<?echo $_GET['name'];?>">Delete</a></td>
		<td bgcolor="444444" class="LeftLink" style="height: 2px;" align="right" valign="top">
		<input type="text" name="txtOrder<?echo $i;?>" size="2" value="<?echo $row['iOrder'];?>">
		<input type="hidden" name="txtid<?echo $i;?>" size="2" value="<?echo $row['iID'];?>">
		</td>
	</tr>
	<?}?>
	<tr>
		<td style="width: 10px; height: 2px;">&nbsp;</td>
		<td width="2" style="height: 2px"></td>
		<td class="LeftLink" style="height: 2px;" align="right" valign="top" colspan="2">
		<input type="submit" value="Submit" name="B2"></td></tr>
	</table>
	<input type="hidden" name="txtTotalCount" size="2" value="<?echo $i;?>">
	</form>
	</td>
	</tr>
</table>
</body>

</html>
