<?php 
	echo('Upload images: 
	<FORM ENCTYPE="multipart/form-data" ACTION="' . $PHP_SELF . '" METHOD="POST"> 
	The file: <INPUT TYPE="file" NAME="userfile"> 
	<INPUT TYPE="submit" VALUE="Upload"> 
	</FORM>'); 
?>
<?
	$path = "../../images/user/"; 
	$max_size = 200000; 
	if (!isset($HTTP_POST_FILES['userfile'])) exit; 
	if (is_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'])) { 
	if ($HTTP_POST_FILES['userfile']['size']>$max_size) { echo "The file is too big<br>n"; exit; } 
	if (($HTTP_POST_FILES['userfile']['type']=="image/gif") || ($HTTP_POST_FILES['userfile']['type']=="image/pjpeg") || ($HTTP_POST_FILES['userfile']['type']=="image/jpeg") || ($HTTP_POST_FILES['userfile']['type']=="image/png")) { 
	if (file_exists($path . $HTTP_POST_FILES['userfile']['name'])) { echo "The file already exists<br>n"; exit; } 
	$res = copy($HTTP_POST_FILES['userfile']['tmp_name'], $path . 
	$HTTP_POST_FILES['userfile']['name']); 
	if (!$res) { echo "upload failed!<br>n"; exit; } else { echo "upload sucessful<br>n"; 
	?>
	<script>
		window.navigate ("insert_image.php?wysiwyg=textarea2");
	</script>
	<?
	} 
	echo "File Name: ".$HTTP_POST_FILES['userfile']['name']."<br>n"; 
	echo "File Size: ".$HTTP_POST_FILES['userfile']['size']." bytes<br>n"; 
	echo "File Type: ".$HTTP_POST_FILES['userfile']['type']."<br>n"; 
	} else { echo "Wrong file type<br>n"; exit; } 
	} 
	$my_file = $HTTP_POST_FILES['userfile']['name']; 
?> 