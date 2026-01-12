<?
	$myFile = "../../images/user/".$_GET['filename'];
	echo $myFile;
	unlink($myFile);
?>
	<script>
		window.navigate ("insert_image.php?wysiwyg=textarea2");
	</script>