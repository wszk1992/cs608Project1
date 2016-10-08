<?php
	ob_start();
	$id = $_POST["id"];
	$title = $_POST["title"];
	$genre = $_POST["genre"];
	$artist = $_POST["artist"];

	$con = mysql_connect("database2.cs.tamu.edu", "wszk1992", "rhr5asiq1") or die('Could not connect to server.');
	mysql_select_db('wszk1992', $con) or die('Could not select database.');
	$sql = "UPDATE music SET title='" . $title . "',genre='" . $genre . "',artist='" . $artist . "' WHERE id=" . $id;
	$result = mysql_query($sql);
	if($result === TRUE) {
		echo "record updated successfully";
	} else {
		echo "Error: " . $sql . "<br>";
	}
	//header("Location: music.php");
	die();
?>