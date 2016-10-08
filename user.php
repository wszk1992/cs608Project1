<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link href="./css/bootstrap.min.css" rel="stylesheet">
 <title>Project1</title>
</head>

<body>
<h1 class=page-header style="margin-left: 30px;" ><a href="./">CSCE 608 PROJECT 1</a></h1>
<div class="container">
<h3>User List</h3>
<table class="table">
 <thead>
 	<tr>
 		<th><a href="?orderBy=id">Id</a></th>
 		<th><a href="?orderBy=username">Username</a></th>
 		<th><a href="?orderBy=title">Favorite</a></th>
 		<th><a href="?orderBy=rate">Rate</a></th>
 	</tr>
 </thead>
 <tbody>
 	<?php
		$con = mysql_connect("database2.cs.tamu.edu", "wszk1992", "rhr5asiq1") or die('Could not connect to server.');
		mysql_select_db('wszk1992', $con) or die('Could not select database.');
		$order = 'id';
		$orderBy = array('id', 'username', 'title', 'rate');
		if($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		}
		if(isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
			$order = $_GET['orderBy'];
		}
		$sql = "SELECT user.id, user.username, music.title, user.rate FROM user INNER JOIN music ON user.favorite=music.id ORDER BY " . $order;
		//echo $sql;
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			echo 
			"<tr>
				<td>" . $row["id"] . "</td>
				<td>" . $row["username"] . "</td>
				<td>" . $row["title"] . "</td>
				<td>" . $row["rate"] . "</td>
			</tr>";

		}
		mysql_free_result($result);
	?>
 </tbody>

</table>
</div>
</body>
</html>