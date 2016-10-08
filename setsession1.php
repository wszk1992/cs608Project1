<?php
	session_start();
	//$_SESSION["search"] = $_POST["search"];
	//echo $_SESSION["search"];
	$_SESSION["content"] = $_POST["content"];
	echo $_SESSION["content"];
    header("Location: music.php");
	//die();
?>