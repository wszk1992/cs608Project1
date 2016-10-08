<?php
	$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
	if($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
	$sql = "DELETE FROM music WHERE id = " . $_POST["id"];
	echo $sql;
	if($con->query($sql) === TRUE) {
		echo "record removed successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}

	$con->close();

	header("Location: ./music.php");
	die();
?>