<?include("db.php");?>
<?
	if($_GET['action']=="delete")
	{
		$sqldelete="delete from tblProductPics where sPicName='".$_GET['pid']."'";
		@mysql_query($sqldelete,$link);
		unlink ("../images/products/tn-".$_GET['pid']);
		unlink ("../images/products/".$_GET['pid']);
		$Message="<font color='red'>Picture Deleted!</font>";
			
	}
?>
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





<?php

$sql = "SELECT MAX(iID) from tblProductPics";
$result=@mysql_query($sql,$link);
$row=mysql_fetch_array($result);
$PHOTOID=$row[0]+1;
$PHOTOID=$_GET['l']."-".$PHOTOID."-tmilock.jpg";

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
    	move_uploaded_file($_FILES["userfile"]["tmp_name"],"../images/products/".$PHOTOID);      



	   $image = new SimpleImage();
	   $image->load('../images/products/'.$PHOTOID);
	   $image->resizeToWidth(200);
	   $image->save('../images/products/tn-'.$PHOTOID);
	   
	   $SQL="insert into tblProductPics (iProductID,sPicName,sPicTitle,sPicDesc)values(".$_GET['id'].",'".$PHOTOID."','".mysql_real_escape_string($_POST['txtTitle'])."','".mysql_real_escape_string($_POST['txtDesc'])."')";
	   @mysql_query($SQL,$link);	   
    }
  }
else
  {
  echo "";
  }

?>

<?
	$sql="select * from tblProducts where iProductID=".$_GET['id'];
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
		<img border="0" src="images/active-link-photo-gallery.jpg" width="200" height="33" alt="Photo Gallery"></a></p>
		<p><a href="press.php">
		<img border="0" src="images/link-press.jpg" width="200" height="33" alt="Events"></a></p>
		<p>
		<br />
		</td>
		<td bgcolor="white" style="width: 20px"></td>
		<td bgcolor="white" valign="top" class="ContentText">
		<h2><br /><?echo $_SESSION['CompanyName'];?></h2>
		
		<form ENCTYPE="multipart/form-data" name="frm" method=post action="product-photos.php?l=<?echo $_GET['l']?>&id=<?echo $_GET['id'];?>">
		<input type=hidden name="action" value="floorplan">
		<table cellpadding="2" width="400" class="ContentText">
		<tr>
		<td valign="top"><b>Picture Title</b></td>
		<td width="247"> <input type="text" name="txtTitle" size="42"></td>
		</tr>
		<tr>
		<td valign="top"><b>Description</b></td>
		<td width="247"> <textarea rows="4" name="txtDesc" cols="25"></textarea></td>
		</tr>
		
		<tr>
		<td valign="top"><b>Upload Image</b></td>
		<td width="247">		<INPUT TYPE="file" NAME="userfile"> 
		<INPUT TYPE="submit" VALUE="Upload"></td>
		</tr>
		
		<tr>
		<td>&nbsp;</td>
		<td width="247"> &nbsp;</td>
		</tr>
		
		<tr>
		<td>&nbsp;</td>
		<td width="247"> &nbsp;</td>
		</tr>
		
		</table>
		<input type=hidden name="action" value="add">
		<?
			$sql1="select * from tblProductPics where iProductID=".$_GET['id'];
			$result1=@mysql_query($sql1,$link);
			while($row1=mysql_fetch_array($result1)){
		?>
		<b><?echo $row1['2'];?></b><br>
		<img src="../images/products/tn-<?echo $row1['sPicName']?>"><br>
		<a href="product-photos.php?id=<?echo $_GET['id'];?>&l=<?echo $_GET['l'];?>&action=delete&pid=<?echo $row1['sPicName'];?>" onclick="return confirm('Are you sure you want to delete the picture?')">Delete Picture</a><hr><p>
		<?}?>
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