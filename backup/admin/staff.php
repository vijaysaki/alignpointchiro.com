<?include("db.php");
		if($_GET['action']=="order")
		{
			$iCount = (int)$_POST['txtTotalCount'];
			for ($i=1;$i<=$iCount;$i++)
			{
				$name="txtid".$i;
				$order="txtOrder".$i;
				$sql="update tblStaff SET iOrder=".$_POST[$order]." where iStaffID=".$_POST[$name];
				echo $sql."<br>";
				$result=@mysql_query($sql,$link);
			}
		}


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

	if($_GET['action']=="delete"){
		$sql="delete from tblStaff where iStaffID=".$_GET['id'];
		$result=@mysql_query($sql,$link);
		$Message="<b><i><font color='red'>Item Deleted!</font></i></b>";
	}
	if($_GET['action']=="add"){
	
	
		$sql1="select max(iStaffID) from tblStaff";
		$result1=@mysql_query($sql1,$link);
		$row1=mysql_fetch_array($result1);
		$iCount=$row1[0]+1;
	
	
	
	
	$PHOTOID=$iCount;
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
			
			echo $PHOTOID;

	    }
	  }
	else
	  {
	  echo "Invalid file";
	  }

	
	
	
	
	
	
	
	
	
	$sql="insert into tblStaff (sStaffName,sPosition,sEmail,sPhone,sStaffInfo)values('".mysql_real_escape_string($_POST['txtName'])."','".mysql_real_escape_string($_POST['txtPosition'])."','".mysql_real_escape_string($_POST['txtEmail'])."','".mysql_real_escape_string($_POST['txtPhone'])."','".mysql_real_escape_string($_POST['txtBio'])."')";
	@mysql_query($sql,$link);
	$Message="<b><i><font color='red'>Changes Saved!</font></i></b>";
	}
	$sql="select * from tblStaff order by iOrder";
	$result=@mysql_query($sql,$link);
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
		<p>Add Staff</p>
		<p><?echo $Message;?></p>
		<form ENCTYPE="multipart/form-data" action="staff.php?action=add" method=post>
		<table border="0" width="432" cellspacing="4" cellpadding="4" class="ContentText">
			<tr>
				<td width="111" valign="top">Staff Name</td>
				<td width="293"><input type="text" name="txtName" size="43"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Picture</td>
				<td width="293" align="left">
				<INPUT TYPE="file" NAME="userfile"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Position</td>
				<td width="293" align="right">
				<p align="left"><input type="text" name="txtPosition" size="43"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Email</td>
				<td width="293"><input type="text" name="txtEmail" size="43"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Phone</td>
				<td width="293" align="right">
				<p align="left"><input type="text" name="txtPhone" size="43"></td>
			</tr>
			<tr>
				<td width="111" valign="top">Staff Bio</td>
				<td width="293" align="right">
				<textarea id="textarea1" rows="9" name="txtBio" cols="34"></textarea>
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
		Edit/Update Services<br>
	<form method=post action="staff.php?action=order">
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
				<td style="width: 10px; height: 2px;"><?echo $row['sStaffName'];?></td>
				<td bgcolor="#444444" width="2" style="height: 2px"><a href="staff-edit.php?id=<?echo $row['iStaffID'];?>">Edit</a></td>
				<td bgcolor="444444" class="LeftLink" style="height: 2px;" align="right" valign="top"><a href="staff.php?action=delete&id=<?echo $row['iStaffID'];?>">Delete</a></td>
				<td bgcolor="444444" class="LeftLink" style="height: 2px;" align="right" valign="top">
				<input type="text" name="txtOrder<?echo $i;?>" size="2" value="<?echo $row['iOrder'];?>">
				<input type="hidden" name="txtid<?echo $i;?>" size="2" value="<?echo $row['iStaffID'];?>">
		
			</tr>
			<?}?>
			<input type="hidden" name="txtTotalCount" size="2" value="<?echo $i;?>">
			<tr>
				<td style="width: 10px; height: 2px;">&nbsp;</td>
				<td width="2" style="height: 2px"></td>
				<td class="LeftLink" style="height: 2px;" align="right" valign="top" colspan="2">
				<input type="submit" value="Submit" name="B2"></td></tr>
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