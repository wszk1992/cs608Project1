<?php
	session_start();
	$_SESSION["genre"] = $_POST["genre"];
	echo $_SESSION["genre"];
	header("Location: music.php");
	die();
?>