<?php
	ob_start();
	$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
	$sql = "DELETE FROM music WHERE id = " . $_POST["id"];
	if($con->query($sql) === TRUE) {
		echo "record removed successfully";
	} else {
		echo "Error: " . $sql . "<br>";
	}

	//mysql_free_result($result);

	header("Location: ./music.php");
	die();
?>