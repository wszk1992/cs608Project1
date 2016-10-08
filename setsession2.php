<?php
	session_start();
	$_SESSION["search"] = $_POST["search"];
	echo $_SESSION["search"];
	//header("Location: music.php");
	//die();
?>