<?
	$link = mysql_connect ("db-mysql-nyc3-41243-do-user-16114214-0.k.db.ondigitalocean.com", "doadmin", "AVNS_sa2vO1ti8ImB60BbBSK") or die ('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db ("alignpoint"); 
	$db=@mysql_select_db("alignpoint",$link);
	
	session_start();
	if(!$_SESSION['loggedin']=="1")
	{
		header("Location: index.php");
	}
?>