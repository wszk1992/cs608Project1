


	  <div class="form-group">
	    <label for="exampleInputArtist">Title</label>
	    <input type="text" class="form-control" id="exampleInputArtist" name="artist">
	  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>
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

	<div data-role="content">
		<div class="row">
			<div class="col-lg-6">
				<form method="post" action="setsession1.php">
					<div data-role="fieldcontain">
					
					
							
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
							   <input type="search" name="content" id="content" placeholder="Searching...">
							   <input class="btn btn-default" type="submit" data-inline="true" value="Go!">
</div>
						 
						
					</div>
				</form>
			</div>
		</div>
	</div>





 <?php
 $con1= new mysqli("localhost", "root", "woshiwudi", "db");
 // Check connection
 if ($con1->connect_error){
 die('Failed to connect to MySQL:' . mysqli_error());}
 $order = 'id';
 $search = '';
 $content = '';
 if (isset($_SESSION["search"]))
 {
    $search = $_SESSION["search"];
 }
if (isset($_SESSION["content"]))
 {
    $content = $_SESSION["content"];
    }
	else $content='title';
 if(isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
 $order = $_GET['orderBy'];
 }
 $result1 = $con1->query("SELECT * FROM music WHERE $search LIKE '%$content%' ORDER BY $order");
 	//	$sql1 ="SELECT * FROM music WHERE $search = '$content' ORDER BY $order";
	//	echo $result1;
	//	$result1 = $con1->query($sql1);
 //echo "SELECT * FROM music WHERE $search = '$content' ORDER BY $order";
 if($result1->num_rows > 0){
 while($row1 = mysqli_fetch_assoc($result1))
 			{
				echo 
				"<tr>
					<td>" . $row1["id"] . "</td>
					<td>" . $row1["title"] . "</td>
					<td>" . $row1["genre"] . "</td>
					<td>" . $row1["artist"] . "</td>
					<td>" . $row1["timestamp"] . "</td>";
?>
				<td>
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</td>
				<?php
				echo "</tr>";
			}
 }
?>
