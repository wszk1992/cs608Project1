<?php
	session_start();
	$title = $_POST["title"];
	$genre = $_POST["genre"];
	$artist = $_POST["artist"];

	$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
	if($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}

	$sql = "INSERT INTO music (title, genre, artist) VALUES ('" . $title . "','" . $genre . "','" . $artist ."')";
	echo $sql;
	if($con->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}

	$con->close();

	header("Location: music.php");
	die();
?>