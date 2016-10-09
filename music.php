<?php
	session_start();
	$orderBy = array('id', 'title', 'genre', 'artist', 'timestamp');
	$genreBy = array('alternative', 'blues', 'classical', 'country', 'electronic', 'hip hop', 'jazz', 'R&amp;B', 'rock');
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link href="./css/bootstrap.min.css" rel="stylesheet">
 <title>Project1</title>
</head>

<body>
<h1 class=page-header style="margin-left: 30px;"><a href="./">CSCE 608 PROJECT 1</a></h1>
<div class="container">

<h3>Music List</h3>
	<div class="dropdown">
	Filter:
	  <button class="btn btn-default dropdown-toggle" type="button" id="genreMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    <?php 
		    if(isset($_SESSION["genre"])) {
		    	echo $_SESSION["genre"];
		    }else {
		    	echo "all";
		    }
	    ?>
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
	<br>
	<button type="button" class="btn btn-default btn-lg" style="padding:5px 10px;font-size: 12px;    border-radius: 10px;" onclick="newMusic()">
	  <span id="button-new-content" class="glyphicon glyphicon-plus" aria-hidden="true"></span> new
	</button>
	<form id="newForm" class="form" style="display: none;" action="/newMusic.php" method="post">
	  <div class="form-group">
	    <label for="exampleInputTitle">Title</label>
	    <input type="text" class="form-control" id="exampleInputTitle" name="title">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputGenre">Genre</label>
	    <select class="form-control" name="genre">
	    <?php
	    	foreach($genreBy as $genre) {
	    		echo "<option>" . $genre . "</option>";
	    	}
		?>
		</select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputArtist">Artist</label>
	    <input type="text" class="form-control" id="exampleInputArtist" name="artist">
	  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>

<div data-role="content">
		<div class="row">
			<div class="col-lg-6">
				<form method="post" action="setsession1.php">
					<div data-role="fieldcontain">
					
					
<!-- wd -->							
<div class="dropdown">
	<label for="search">Search: </label>
							
<button class="btn btn-default dropdown-toggle" type="button" id="attribute" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
								<?php 
									if(isset($_SESSION["search"])) {
									echo $_SESSION["search"];}
									else {
										echo "Title";}
								?>  
			    			<span class="caret"></span>
	 						</button>
            				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" id="dropdown1" >
                				<li><a href="#">Id</a></li>
                				<li><a href="#">Title</a></li>
                				<li><a href="#">Genre</a></li>
               					<li><a href="#">Artist</a></li>
                				<li><a href="#">Timestamp</a></li>
           				    </ul>
							   <input type="search" name="content" id="content" placeholder="Searching..." value=<?php echo $_SESSION["content"] ?>>
							   <input class="btn btn-default" type="submit" data-inline="true" value="Go!">
</div>
						 
						
					</div>
				</form>
			</div>
		</div>
	</div>

<!-- wd-end -->	
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
	<tbody id="musicBody">
	
	<?php
		$con = new mysqli("localhost", "root", "rhr5asiq1", "db");
		if($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		}
		$order = 'id';
		$genre = '';
		$search = '';
		$content = '';
		if (isset($_SESSION["search"])) {
			$search = $_SESSION["search"];
		}else {
			$search = 'title';	
		} 
		if (isset($_SESSION["content"])) {
			$content = $_SESSION["content"];
		}else {
			$content='';
		}

		if(isset($_SESSION["genre"]) && in_array($_SESSION["genre"], $genreBy)) {
			$genre = $_SESSION["genre"];
			if($genre === 'all') {
				$genre = '';
			}else {
				if($genre === 'R&amp;B') {
					$genre = 'R&B';
				}
				$genre = "and genre = '" . $genre . "'";
			}
		}
		if(isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
			$order = $_GET['orderBy'];
		}

 		$result = $con->query("SELECT * FROM music WHERE $search LIKE '%$content%' $genre ORDER BY $order");
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				?>
				
				<?php
				echo 
				"
				<tr id='" . $row["id"] . "'>
					<td>" . $row["id"] . "</td>
					<td>" . $row["title"] . "</td>
					<td>" . $row["genre"] . "</td>
					<td>" . $row["artist"] . "</td>
					<td>" . $row["timestamp"] . "</td>";
				?>
					<td>
					<div><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="opacity:0.3" onclick="modifyMusic(this)" onmouseover="over(this)" onmouseout="out(this)"></span><div>
					<div><span class="glyphicon glyphicon-remove" aria-hidden="true" style="opacity:0.3" onclick="removeMusic(this)" onmouseover="over(this)" onmouseout="out(this)"></span><div>
					</td>
				</tr>
				<?php
			}
		}
		$con->close();
	?>
	</tbody>

</table>
</div>

<script src="./javascripts/jquery-3.1.0.min.js"></script>
<script src="./javascripts/bootstrap.min.js"></script>
<script type="text/javascript">
	var ul = document.getElementById("dropdown");
	var genres = ul.getElementsByTagName("li");
	for(var i = 0; i < genres.length; i++) {
		var genre = genres[i].getElementsByTagName("a")[0];
		genre.addEventListener('click', function() {
			$.post('./setsession.php',{genre: this.innerHTML});
			//console.log(this.innerHTML);
			window.location = "./music.php";
		}, false); 
	}
	//wd
	var ul = document.getElementById("dropdown1");
	var searches = ul.getElementsByTagName("li");
	for(var i = 0; i < searches.length; i++) {
		var search = searches[i].getElementsByTagName("a")[0];
		search.addEventListener('click', function() {
			$.post('./setsession2.php',{search: this.innerHTML});
		//	console.log(this.innerHTML);
			document.getElementById("attribute").innerHTML = this.innerHTML;
		//	window.location = "./music.php";
		}, false); 
	}
	//wd--end
	function newMusic() {
		var newForm = document.getElementById("newForm");
		if(newForm.style.display === 'block') {
			document.getElementById("button-new-content").className = "glyphicon glyphicon-plus";
			newForm.style.display = 'none';
		} else {
			document.getElementById("button-new-content").className = "glyphicon glyphicon-minus";
			newForm.style.display = 'block';
		}

	}

	function over(obj) {
		obj.style.opacity = 1;
	}

	function out(obj) {
		obj.style.opacity = 0.3;
	}

	function removeMusic(obj) {
		var id = $(obj).closest("tr").children()[0].innerHTML;
		$.post('./removeMusic.php',{id: id});
		$("#" + id).remove();
	}

	function modifyMusic(obj) {
		var genreBy = ['alternative', 'blues', 'classical', 'country', 'electronic', 'hip hop', 'jazz', 'R&amp;B', 'rock'];
		var title = $(obj).closest("tr").children()[1].innerHTML;
		var genre = $(obj).closest("tr").children()[2].innerHTML;
		var artist = $(obj).closest("tr").children()[3].innerHTML;
		$(obj).closest("tr").children()[1].innerHTML = "<input type='text' name='title' value='" + title + "'>";
		var allGenre;
		for(let gen of genreBy) {
			if(gen === genre) {
				allGenre += "<option selected='selected'>" + gen + "</option>";
			}else {
				allGenre += "<option>" + gen + "</option>";				
			}
		}
		$(obj).closest("tr").children()[2].innerHTML = "<select class='form-control' selected='selected' name='genre'>" + allGenre + "</select>";
		$(obj).closest("tr").children()[3].innerHTML = "<input type='text' name='artist' value='" + artist + "'>";
		$(obj).closest("tr").children()[5].innerHTML = "<button type='button' class='btn btn-default' onclick='submitModifyMusic(this)'>Submit</button><button type='button' class='btn btn-default' onclick='returnModifyMusic(this,\"" + title +"\",\"" + genre + "\",\"" + artist + "\")'>Cancel</button>";
	}

	function submitModifyMusic(obj) {
		var id = $(obj).closest("tr").children()[0].innerHTML.replace("<br>","");
		console.log(id);
		var title = $(obj).closest("tr").children()[1].firstChild.value;
		var genre = $(obj).closest("tr").children()[2].firstChild.value;
		var artist = $(obj).closest("tr").children()[3].firstChild.value;
		$.post('./modifyMusic.php',{id:id, title:title, genre:genre, artist:artist}, function() {
			returnModifyMusic(obj, title, genre, artist);
		});
	}

	function returnModifyMusic(obj, title, genre, artist) {
		$(obj).closest("tr").children()[1].innerHTML = title;
		$(obj).closest("tr").children()[2].innerHTML = genre;
		$(obj).closest("tr").children()[3].innerHTML = artist;
		$(obj).closest("tr").children()[5].innerHTML = "<div><span class='glyphicon glyphicon-pencil' aria-hidden='true' style='opacity:0.3' onclick='modifyMusic(this)'' onmouseover='over(this)' onmouseout='out(this)'></span></div><div><span class='glyphicon glyphicon-remove' aria-hidden='true' style='opacity:0.3' onclick='removeMusic(this)' onmouseover='over(this)' onmouseout='out(this)'></span></div>";
	}

</script>
</body>
</html>
