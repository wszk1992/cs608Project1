<?php
	$id = $_POST["id"];
	$title = $_POST["title"];
	$genre = $_POST["genre"];
	$artist = $_POST["artist"];

	$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
	$sql = "UPDATE music SET title='" . $title . "',genre='" . $genre . "',artist='" . $artist . "' WHERE id=" . $id;
	if($con->query($sql) === TRUE) {
		echo "record updated successfully";
	} else {
		echo "Error: " . $sql . "<br>";
	}
	header("Location: ./music.php");
?>