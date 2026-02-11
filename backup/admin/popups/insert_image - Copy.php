<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>openWYSIWYG | Select Color</title>
</head>
<script language="JavaScript" type="text/javascript">

var qsParm = new Array();


/* ---------------------------------------------------------------------- *\
  Function    : retrieveWYSIWYG()
  Description : Retrieves the textarea ID for which the image will be inserted into.
\* ---------------------------------------------------------------------- */
function retrieveWYSIWYG() {
  var query = window.location.search.substring(1);
  var parms = query.split('&');
  for (var i=0; i<parms.length; i++) {
    var pos = parms[i].indexOf('=');
    if (pos > 0) {
       var key = parms[i].substring(0,pos);
       var val = parms[i].substring(pos+1);
       qsParm[key] = val;
    }
  }
}


/* ---------------------------------------------------------------------- *\
  Function    : insertImage()
  Description : Inserts image into the WYSIWYG.
\* ---------------------------------------------------------------------- */
function insertImage() {

  var image = '<img src="' + document.getElementById('imageurl').value + '" alt="' + document.getElementById('alt').value + '" alignment="' + document.getElementById('alignment').value + '" border="' + document.getElementById('borderThickness').value + '" hspace="' + document.getElementById('horizontal').value + '" vspace="' + document.getElementById('vertical').value + '">';
  window.opener.insertHTML(image, qsParm['wysiwyg']);
  window.close();
}

</script>
<body bgcolor="#EEEEEE" marginwidth="0" marginheight="0" topmargin="0" leftmargin="0" onLoad="retrieveWYSIWYG();">

<table border="0" cellpadding="0" cellspacing="0" style="padding: 10px;" width=700><tr>
	<td width="380" valign="top">

<span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;">Insert Image:</span>
<table width="380" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;" width="380" colspan="2">
	<b>Select your image to from the right panel to paste in the editor</b></td>
 </tr>
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;" width="80">Image URL:</td>
	<td style="padding-bottom: 2px; padding-top: 0px;" width="300"><input type="text" name="imageurl" id="imageurl" value=""  style="font-size: 10px; width: 100%;"></td>
 </tr>
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Alternate Text:</td>
	<td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="alt" id="alt" value=""  style="font-size: 10px; width: 100%;"></td>
 </tr>
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">
	Wrap Text </td>
	<td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">
	<input type="radio" value="wrpLeft" checked name="wrp">Left <input type="radio" value="wrp" checked name="wrpRight">Right</td>
 </tr>
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">&nbsp;</td>
	<td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">
	<a href="upload.php">Click here to Upload</a></td>
 </tr>
</table>
	


<table width="380" border="0" cellpadding="0" cellspacing="0" style="margin-top: 10px;"><tr><td>

<span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;">Layout:</span>
<table width="185" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;" width="100">Alignment:</td>
	<td style="padding-bottom: 2px; padding-top: 0px;" width="85">
	<select name="alignment" id="alignment" style="font-family: arial, verdana, helvetica; font-size: 11px; width: 100%;">
	 <option value="">Not Set</option>
	 <option value="left">Left</option>
	 <option value="right">Right</option>
	 <option value="texttop">Texttop</option>
	 <option value="absmiddle">Absmiddle</option>
	 <option value="baseline">Baseline</option>
	 <option value="absbottom">Absbottom</option>
	 <option value="bottom">Bottom</option>
	 <option value="middle">Middle</option>
	 <option value="top">Top</option>
	</select>
	</td>
 </tr>
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Border Thickness:</td>
	<td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="borderThickness" id="borderThickness" value=""  style="font-size: 10px; width: 100%;"></td>
 </tr>
</table>	

</td>
<td width="10">&nbsp;</td>
<td>

<span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;">Spacing:</span>
<table width="185" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;" width="80">Horizontal:</td>
	<td style="padding-bottom: 2px; padding-top: 0px;" width="105"><input type="text" name="horizontal" id="horizontal" value=""  style="font-size: 10px; width: 100%;"></td>
 </tr>
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Vertical:</td>
	<td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="vertical" id="vertical" value=""  style="font-size: 10px; width: 100%;"></td>
 </tr>
</table>	

</td></tr></table>

<div align="right" style="padding-top: 5px;"><input type="submit" value="  Submit  " onClick="insertImage();" style="font-size: 12px;" >&nbsp;<input type="submit" value="  Cancel  " onClick="window.close();" style="font-size: 12px;" ></div>

</tr></td>
	<td width="280" valign="top">

	<table>
	<?php 
		if ($handle = opendir('../../images/user/')) { 
		    while (false !== ($file = readdir($handle))) {
	?>
		<tr>
	<?
		if($file!="." && $file!="..")
		    	{ 
	?><td><a href='#'><img border="0" onclick="javascript:document.getElementById('imageurl').value='http://goltergraphix.rojaysoft.com/images/user/<?echo $file;?>'" height=100 width=100 src="http://goltergraphix.rojaysoft.com/images/user/<?echo $file;?>"></a><br><a href='delete.php?filename=<?echo $file?>'>Delete</a></td>
	<?	
	        }
		if($file!="." && $file!="..")
				{
		        	$file = readdir($handle);
		        	if($file!="")
		        	{
	?>
		        		<td><a href='#'><img border="0" onclick="javascript:document.getElementById('imageurl').value='http://goltergraphix.rojaysoft.com/images/user/<?echo $file;?>'" height=100 width=100 src="http://goltergraphix.rojaysoft.com/images/user/<?echo $file;?>"></a><br><a href='delete.php?filename=<?echo $file?>'>Delete</a></td>
	<?	
		        	}
		        }
	?>
		</tr>
	<?
		    } 
		    closedir($handle); 
		} 
	?>
	</table>


	</tr></table>

	<td valign="top">
	</tr>

</body>
</html>