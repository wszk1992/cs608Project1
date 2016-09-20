<?php
$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
if($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}
$num = 0;
while($num++ < 1000) {
	$username = generateRandomString();
	$favorite = rand(1,1326);
	$rate = rand(0,4) + rand(0,9) / 10.0;
	$sql = "INSERT INTO user(username, favorite, rate) VALUE ('$username', '$favorite', '$rate');";
	if($con->query($sql) !== TRUE) {
		echo "error:" . $sql . "<br>" . $con->error;
		break;
	}
}
echo "finished";
$con->close();

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>