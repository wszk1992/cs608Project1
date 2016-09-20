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
<div class="container">
<h1 class=page-header>CSCE 608 PROJECT 1</h1>
<h3>Music List</h3>
	<div class="dropdown">
	Filter:
	  <button class="btn btn-default dropdown-toggle" type="button" id="genreMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    all
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="dropdown">
	  	<li><a href="#">all</a></li>
	    <li><a href="#">alternative</a></li>
	    <li><a href="#">blues</a></li>
	    <li><a href="#">classical</a></li>
	    <li><a href="#">country</a></li>
	    <li><a href="#">electronic</a></li>
	    <li><a href="#">hip hop</a></li>
	    <li><a href="#">jazz</a></li>
	    <li><a href="#">R&B</a></li>
	    <li><a href="#">rock</a></li>
	  </ul>
	</div>
<table class="table">
 <thead>
 	<tr>
 		<th><a href="?orderBy=id">Id</a></th>
 		<th><a href="?orderBy=title">Title</a></th>
 		<th><a href="?orderBy=genre">Genre</a></th>
 		<th><a href="?orderBy=artist">Artist</a></th>
 		<th><a href="?orderBy=timestamp">Timestamp</a></th>
 	</tr>
 </thead>
 <tbody>
 	<?php
		$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
		if($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		}
		$orderBy = array('id', 'title', 'genre', 'artist', 'timestamp');
		$genreBy = array('alternative', 'blues', 'classical', 'country', 'electronic', 'hip hop', 'jazz', 'R&B', 'rock');
		$order = 'id';
		$genre = '';
		if(isset($_SESSION["genre"]) && in_array($_SESSION["genre"], $genreBy)) {
			$genre = $_SESSION["genre"];
			if($genre === 'all') {
				$genre = '';
			}else {
				$genre = " WHERE genre = '" . $genre . "'";
			}
		}
		if(isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
			$order = $_GET['orderBy'];
		}

		$sql = "SELECT * FROM music " . $genre . " ORDER BY " . $order;
		echo $sql;
		$result = $con->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				echo 
				"<tr>
					<td>" . $row["id"] . "</td>
					<td>" . $row["title"] . "</td>
					<td>" . $row["genre"] . "</td>
					<td>" . $row["artist"] . "</td>
					<td>" . $row["timestamp"] . "</td>
				</tr>";

			}
		}
		$con->close();
	?>
 </tbody>

</table>
</div>

<script src="javascripts/jquery-3.1.0.min.js"></script>
<script src="javascripts/bootstrap.min.js"></script>
<script type="text/javascript">
	var ul = document.getElementById("dropdown");
	var genres = ul.getElementsByTagName("li");
	for(var i = 0; i < genres.length; i++) {
		var genre = genres[i].getElementsByTagName("a")[0];
		genre.addEventListener('click', function() {
			$.post('/setsession.php',{genre: this.innerHTML});
			console.log(this.innerHTML);
			window.location = "/music.php";
		}, false); 
	}

</script>
</body>
</html>
