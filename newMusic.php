<?php
	session_start();
	$title = $_POST["title"];
	$genre = $_POST["genre"];
	$artist = $_POST["artist"];

	$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
	$sql = "INSERT INTO music (title, genre, artist) VALUES ('" . $title . "','" . $genre . "','" . $artist ."')";
	if($con->query($sql)=== TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>";
	}
	header("Location: ./music.php");
	die();
?>