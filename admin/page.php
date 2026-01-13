<?php
require_once("db.php");

$pdo = db();
$Message = '';
$page = $_GET['page'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit' && $page) {
    $sql = "UPDATE pages SET title = :title, content = :content WHERE slug = :page";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $_POST['txtTitle'] ?? '',
        ':content' => $_POST['txtContent'] ?? '',
        ':page' => $page
    ]);
    $Message = "<b><i><font color='red'>Changes Saved!</font></i></b>";
}

$sql = "SELECT * FROM pages WHERE slug = :page";
$stmt = $pdo->prepare($sql);
$stmt->execute([':page' => $page]);
$row = $stmt->fetch();
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
		<?php include('left_menu.php'); ?>
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