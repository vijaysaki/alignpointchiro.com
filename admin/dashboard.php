<?php
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

//echo "dashboard reached<br>";

require_once(__DIR__ . "/db.php");

$pdo = db();
$Message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $sql = "UPDATE pages SET title = :title, content = :content WHERE slug = 'index'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $_POST['txtTitle'] ?? '',
        ':content' => $_POST['content1'] ?? ''
    ]);
    $Message = "<b><i><font color='red'>Changes Saved!</font></i></b>";
}

$sql = "SELECT * FROM pages WHERE slug = 'index'";
$stmt = $pdo->query($sql);
$row = $stmt->fetch() ?: ['title' => '', 'content' => ''];

?>

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Manage Your Property - <?= $_SESSION['CompanyName'];?></title>
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
				<?php include('left_menu.php'); ?>
			</tr>
		</table>
		</center>
			<br />
			<?= date("l, F d, Y h:i" ,time());?>&nbsp; <br />
		<br />
		<a target="_blank" class="LeftLink" href="http://www.calaispark.com">View the Site</a> | 
		<a class="LeftLink" href="sign-out.php">Sign Out&nbsp; </a> <br />
		&nbsp;<p><a href="dashboard.php">
		<img border="0" src="images/active-link-dashboard.jpg" width="200" height="33" alt="Dashboard"></a></p>
		<p>
		<a href="products.php">
		<img border="0" src="images/link-manage-products.jpg" width="200" height="33" alt="Manage Products"></a></p>
		<p><a href="services.php">
		<img border="0" src="images/link-manage-services.jpg" width="200" height="33" alt="Manage Services"></a></p>
		<p>
		<a href="resources.php">
		<img border="0" src="images/link-manage-resources.jpg" width="197" height="33" alt="Manage Resources"></a><br>
		<br>
		<a href="about-us.php">
		<img border="0" src="images/link-manage-about-us.jpg" width="197" height="33" alt="Manage About Us"></a><br>
		<br>
		<a href="staff.php">
		<img border="0" src="images/link-manage-staff.jpg" width="200" height="33" alt="Manage Staff"></a></p>
		<p>
		<a href="page.php?page=index">
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
		<h2><br /><?= $_SESSION['CompanyName'];?></h2>
		<p><b>Quick Intro</b></p>
		<p>Welcome to the administrative area, use the links of the links of the 
		left side of the page to access the website&#39;s editing options.</p>
		<p><?= $Message;?></p>
		<form action="dashboard.php" method=post>
		<input type=hidden name="action" value="edit">
		&nbsp;<table border="0" width="76%" class="ContentText" cellspacing="3" cellpadding="3">
			<tr>
				<td width="473" colspan="2"><b>Homepage</b></td>
			</tr>
			<tr>
				<td width="65">&nbsp;</td>
				<td width="408">&nbsp;</td>
			</tr>
			<tr>
				<td width="65"><b>English</b></td>
				<td width="408">&nbsp;</td>
			</tr>
			<tr>
				<td width="65">&nbsp;</td>
				<td width="408">&nbsp;</td>
			</tr>
			<tr>
				<td width="65"><b>Title</b></td>
				<td width="408">
				<input type="text" name="txtTitle" size="30" value="<?= $row['title'];?>"></td>
			</tr>
			<tr>
				<td width="65" valign="top"><b>Content</b></td>
				<td width="408"><textarea id="textarea1" rows="7" name="content1" cols="30"><?= $row['content'];;?></textarea>
				<script language="javascript1.2">generate_wysiwyg('textarea1');	</script>
				</td>
			</tr>
			<tr>
				<td width="65">&nbsp;</td>
				<td width="408">&nbsp;</td>
				</tr>
			<tr>
				<td width="473" colspan="2"><b>Spanish</b></td>
				</tr>
			<tr>
				<td width="65">&nbsp;</td>
				<td width="408">&nbsp;</td>
				</tr>
			<tr>
				<td width="65">&nbsp;</td>
				<td width="408"><input type="submit" value="Submit" name="B1"></td>
			</tr>
		</table>
		</form>
		<p>&nbsp;</p>
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
