<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link href="/css/bootstrap.min.css" rel="stylesheet">
 <title>Project1</title>
</head>

<body>
<h1>CSCE 608 PROJECT 1</h1>
<h3>User List</h3>
<table class="table">
 <thead>
 	<tr>
 		<th>Id</th>
 		<th>Username</th>
 		<th>Favorite</th>
 		<th>Rate</th>
 	</tr>
 </thead>
 <tbody>
 	<?php
		$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
		if($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		}
		$sql = "SELECT * FROM user ORDER BY id ";
		$result = $con->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["favorite"] . "</td><td>" . $row["rate"] . "</td></tr>";

			}
		}
		$con->close();
	?>
 </tbody>

</table>
</body>
</html>