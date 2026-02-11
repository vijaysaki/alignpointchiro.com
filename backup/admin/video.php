<?php
if($_GET['action']=="video"){
	$allowedExts = array("wmv","avi","mpeg","mpg");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	if ((($_FILES["file"]["type"] == "video/avi")|| ($_FILES["file"]["type"] == "video/mpeg")
	|| ($_FILES["file"]["type"] == "video/wmv")
	|| ($_FILES["file"]["type"] == "video/mpg"))
	&& ($_FILES["file"]["size"] < 200000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["file"]["error"] > 0)
	    {
	    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	    }
	  else
	    {
	    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	    echo "Type: " . $_FILES["file"]["type"] . "<br>";
	    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
	
	    if (file_exists("../videos/" . $_FILES["file"]["name"]))
	      {
	      echo $_FILES["file"]["name"] . " already exists. ";
	      }
	    else
	      {
	      move_uploaded_file($_FILES["file"]["tmp_name"],
	      "../videos/" . $_FILES["file"]["name"]);
	      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	      }
	    }
	  }
	else
	  {
	  echo "Invalid file";
	  }
 }
?>
<html>
<body>

<form action="video.php" method="post"
enctype="multipart/form-data">
<input type=hidden name="action" value="video">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>