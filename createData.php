<?php
$myfile = fopen("data.txt",'r') or die("Unable to open file!");
$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
if($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}
while(($line = fgets($myfile)) !== false) {
	$attrs = explode("|", $line);
	$title = addslashes($attrs[0]);
	$artist = addslashes($attrs[1]);
	$timestamp = addslashes($attrs[2]);
	$genre = addslashes($attrs[3]);
	$sql = "INSERT INTO music(title, artist, timestamp, genre) VALUE ('$title', '$artist', '$timestamp', '$genre');";
	if($con->query($sql) !== TRUE) {
		echo "error:" . $sql . "<br>" . $con->error;
		break;
	}
}
echo "finished";
$con->close();
?>