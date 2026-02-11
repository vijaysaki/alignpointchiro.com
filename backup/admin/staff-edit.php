<?include("db.php");?>
<?
class SimpleImage {
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
 
}
?>

<?
	if($_POST['action']=="edit"){
	
	$PHOTOID=$_GET['id'];
	$PHOTOID=$PHOTOID."-staff.jpg";
	
	if ((($_FILES["userfile"]["type"] == "image/gif")
	|| ($_FILES["userfile"]["type"] == "image/jpeg")
	|| ($_FILES["userfile"]["type"] == "image/pjpeg"))
	&& ($_FILES["userfile"]["size"] < 2000000))
	  {
	  if ($_FILES["userfile"]["error"] > 0)
	    {
	    echo "Return Code: " . $_FILES["userfile"]["error"] . "<br />";
	    }
	  else
	    {
	    	move_uploaded_file($_FILES["userfile"]["tmp_name"],"../images/staff/".$PHOTOID);      
	
	
	
		   $image = new SimpleImage();
		   $image->load('../images/staff/'.$PHOTOID);
		   $image->resizeToWidth(200);
		   $image->save('../images/staff/tn-'.$PHOTOID);
	    }
	  }
	else
	  {
	  echo "Invalid file";
	  }



	$sql="update tblStaff SET sStaffName='".mysql_real_escape_string($_POST['txtName'])."',sPosition='".mysql_real_escape_string($_POST['txtPosition'])."',
	sPosition_ES='".mysql_real_escape_string($_POST['txtPosition_ES'])."',sPosition_PT='".mysql_real_escape_string($_POST['txtPosition_PT'])."',sEmail='".mysql_real_escape_string($_POST['txtEmail'])."',
	sPhone='".mysql_real_escape_string($_POST['txtPhone'])."',sStaffInfo='".mysql_real_escape_string($_POST['txtBio'])."',sStaffInfo_ES='".mysql_real_escape_string($_POST['txtBio_ES'])."',
	sStaffInfo_PT='".mysql_real_escape_string($_POST['txtBio_PT'])."' where iStaffID=".$_GET['id'];
	@mysql_query($sql,$link);
	$Message="<b><i><font color='red'>Changes Saved!</font></i></b>";
	}
	$sql="select * from tblStaff where iStaffID=".$_GET['id'];
	$result=@mysql_query($sql,$link);
	$row=mysql_fetch_array($result);
?>

<?include("db.php");?>
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
		<img border="0" src="images/active-link-manage-staff.jpg" width="200" height="33" alt="Manage Staff"></a></p>
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
		<p><b>Manage Staff</b></p>
		<p>Edit Staff</p>
		<p><?echo $Message;?></p>
		<form  ENCTYPE="multipart/form-data" action="staff-edit.php?id=<?echo $_GET['id']?>" method=post>
		<input type=hidden name="action" value="edit">
		<table border="0" width="432" cellspacing="4" cellpadding="4" class="ContentText">
			<tr>
				<td width="111" valign="top">Staff Name</td>
				<td width="293"><input type="text" name="txtName" size="43" value="<?echo $row['sStaffName'];?>"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Picture</td>
				<td width="293" align="left">
				<INPUT TYPE="file" NAME="userfile"><p>
				<img src="../images/staff/tn-<?echo $row['iStaffID'];?>-staff.jpg">
				</td>
			</tr>
			<tr>
				<td width="111" valign="top">Email</td>
				<td width="293"><input type="text" name="txtEmail" size="43" value="<?echo $row['sEmail'];?>"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Phone</td>
				<td width="293" align="right">
				<p align="left"><input type="text" name="txtPhone" size="43" value="<?echo $row['sPhone'];?>"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Position</td>
				<td width="293" align="right">
				<p align="left"><input type="text" name="txtPosition" size="43" value="<?echo $row['sPosition'];?>"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Staff Bio</td>
				<td width="293" align="right">
				<textarea id="textarea1" rows="9" name="txtBio" cols="34"><?echo $row['sStaffInfo'];?></textarea>
				<script language="javascript1.2">generate_wysiwyg('textarea1');	</script>
				</td>
			</tr>
			<tr>
				<td width="111" valign="top">&nbsp;</td>
				<td width="293" align="right">
				&nbsp;</td>
			</tr>
			<tr>
				<td width="111" valign="top">Position<br>
				(Spanish)</td>
				<td width="293" align="left" valign="top">
				<input type="text" name="txtPosition_ES" size="43" value="<?echo $row['sPosition_ES'];?>"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Staff Bio<br>
				(Spanish)</td>
				<td width="293" align="left"><textarea id="textarea2" rows="9" name="txtBio_ES" cols="34"><?echo $row['sStaffInfo_ES'];?></textarea>
				<script language="javascript1.2">generate_wysiwyg('textarea2');	</script>
				&nbsp;</td>
			</tr>
			<tr>
				<td width="111" valign="top">&nbsp;</td>
				<td width="293" align="left">
				&nbsp;</td>
			</tr>
			<tr>
				<td width="111" valign="top">Position<br>
				(Portuguese)</td>
				<td width="293" align="left" valign="top">
				<input type="text" name="txtPosition_PT" size="43" value="<?echo $row['sPosition_PT'];?>"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Staff Bio<br>
				(Portuguese)</td>
				<td width="293" align="left"><textarea id="textarea3" rows="9" name="txtBio_PT" cols="34"><?echo $row['sStaffInfo_PT'];?></textarea>
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