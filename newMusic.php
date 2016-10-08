<?php
	ob_start();
	session_start();
	$title = $_POST["title"];
	$genre = $_POST["genre"];
	$artist = $_POST["artist"];

	$con = mysql_connect("database2.cs.tamu.edu", "wszk1992", "rhr5asiq1") or die('Could not connect to server.');
	mysql_select_db('wszk1992', $con) or die('Could not select database.');
	$sql = "INSERT INTO music (title, genre, artist) VALUES ('" . $title . "','" . $genre . "','" . $artist ."')";
	$result = mysql_query($sql);
	if($result === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>";
	}

	//mysql_free_result($result);

	header("Location: ./music.php");
	die();
?>