<?php
	$id = $_POST["id"];
	$title = $_POST["title"];
	$genre = $_POST["genre"];
	$artist = $_POST["artist"];

	$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
	if($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
	$sql = "UPDATE music SET title='" . $title . "',genre='" . $genre . "',artist='" . $artist . "' WHERE id=" . $id;
	//echo $sql;
	if($con->query($sql) === TRUE) {
		echo "record updated successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}

	$con->close();
	//header("Location: music.php");
	die();
?>