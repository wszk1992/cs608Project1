<?php
	ob_start();
	$con = mysql_connect("database2.cs.tamu.edu", "wszk1992", "rhr5asiq1") or die('Could not connect to server.');
	mysql_select_db('wszk1992', $con) or die('Could not select database.');
	$sql = "DELETE FROM music WHERE id = " . $_POST["id"];
	$result = mysql_query($sql);
	if($result === TRUE) {
		echo "record removed successfully";
	} else {
		echo "Error: " . $sql . "<br>";
	}

	//mysql_free_result($result);

	header("Location: ./music.php");
	die();
?>