<?php
    session_start();
    
    $con = mysqli_connect("localhost", "root", "root", "music_store");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

	$page = $_GET["page"];
    if ($page == "" || $page == "1") {
        $current = 0;
        $page = 1;
    }
    else {
        $current = ($page * 5) - 5;
    }

	$artist = $_GET["artist"];
	$album = $_GET["album"];

	if (!empty($artist)) {
     	$query = "SELECT songs.s_title, songs.s_price, songs.s_rating, songs.s_genre, songs.s_year, songs.song_id, artists.a_name, albums.a_title, album_image.album_im
    	FROM songs
    	INNER JOIN albums ON albums.album_id = songs.album_id    
		INNER JOIN artists ON artists.artist_id = albums.artist_id AND artists.a_name = '$artist'
		INNER JOIN album_image ON album_image.album_id = albums.album_id
		WHERE songs.availability = 'yes'
		LIMIT $current, 5";
	}

	else if (!empty($album)) {
    	$query = "SELECT songs.s_title, songs.s_price, songs.s_rating, songs.s_genre, songs.s_year, songs.song_id, artists.a_name, albums.a_title, album_image.album_im
    	FROM songs
    	INNER JOIN albums ON albums.album_id = songs.album_id AND albums.a_title = '$album'
		INNER JOIN artists ON artists.artist_id = albums.artist_id
		INNER JOIN album_image ON album_image.album_id = albums.album_id
		WHERE songs.availability = 'yes'
		LIMIT $current, 5";	
	}

	else {
    	$query = "SELECT songs.s_title, songs.s_price, songs.s_rating, songs.s_genre, songs.s_year, songs.song_id, artists.a_name, albums.a_title, album_image.album_im
    	FROM songs
    	INNER JOIN albums ON albums.album_id = songs.album_id    
		INNER JOIN artists ON artists.artist_id = albums.artist_id
		INNER JOIN album_image ON album_image.album_id = albums.album_id
		WHERE songs.availability = 'yes'
		LIMIT $current, 5";
	}

    $result = mysqli_query($con, $query);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Musicstore</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/responsiveslides.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/responsiveslides.min.js"></script>
		  <script>
		    // You can also use "$(window).load(function() {"
			    $(function () {
			
			      // Slideshow 1
			      $("#slider1").responsiveSlides({
			        maxwidth: 1600,
			        speed: 600
			      });
			});
		  </script>
		  <script>
			$window.load(function() {
				$('#Cat').onclick(function(){
					$('#new').html ="Hello";
			
			}
			}
		  </script>
	</head>
	<body>
		<!---start-wrap-->
		<div class="wrap">
			<!---start-header-->
			<div class="header">
				<div class="sub-header">
				<div class="logo">
					<a href="index.html"><img src="images/logo4.png" title="logo" /></a>
				</div>
			</div> <br />
			<div class="header">	
				<div class="sub-header-center">
					<form action="search.php" method="get">
						<select id="cat" name="category">
							<option value="1">Song</option>
							<option value="2">Artist</option>
							<option value="3">Album</option>
						</select>
						<p id="new"></p>	
						<input type="text" name='product'><input type="submit"  value="search" />
					</form>
				</div>
				<div class="sub-header-right">
					<ul>
						<?php
						if ( !isset($_SESSION['sess_username']) || trim($_SESSION['sess_username'])=='' )
						{
							//header('location:http://localhost/musicstore/albums.php');
							echo "<li><a href='login.html'>User login</a></li>";
							echo "<li><a href='admin.html'>Admin login</a></li>";
							echo "<li><a href='cart.php' class='user_tab'>CART: <img src='images/cart.png' title='cart' /></a></li>";
							
						}
						else
						{
							echo "<li><a href='#' class='user_tabs'>".$_SESSION['sess_username']."</a></li>";
							if ($_SESSION['sess_type'] == 'admin') 
							{
								echo "<li><a href='admin.php' id='admin_task' class='user_tab' > Admin Task</a></li>";
								echo "<li><a href='php/logout.php' class='user_tab'> Logout</a></li>";
							}
							else
							{
								echo "<li><a href='history.php' class='user_tab'> Orders</a></li>";
								echo "<li><a href='php/logout.php' class='user_tab'> Logout</a></li>";
								echo "<li><a href='cart.php' class='user_tab'>CART: <img src='images/cart.png' title='cart' /></a></li>";
							}
							
						}
						?>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
			<div class="clear"> </div>
			<div class="top-nav">
				<ul>
					<li><a href="index1.php">Home</a></li>
					<li><a href="albums.php">Albums</a></li>
					<li><a href="artists.php">Artists</a></li>
					<li class="active1"><a href="listproducts.php">Songs</a></li>
					<?php
						if ($_SESSION['sess_type'] != 'admin') {
							echo "<li><a href='feedback.php'>Feedback</a></li>";
						}
					?>
					<div class="clear"> </div>
				</ul>
			</div>
			<div class="content">
					<div class="Cartires">
                        <h5>Products</h5>
					<?php
					
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<div class='cartires-grids'>";
  	    	            	echo "<div class='cartire-grid'>";
 	                        echo "<div class='cartire-grid-img'>";
							echo '<img class="album" src="data:image/jpeg;base64,' . base64_encode($row['album_im'] ) . '"/>';	
							echo "</div>";
  	  	                	echo "<div class='cartire-grid-info'>";
							echo  "Song Title : " . $row['s_title'] . "<br />";
							echo  "Artist : " . $row['a_name'] . "<br />";
							echo  "Release Year : " . $row['s_year'] . "<br />";	
							echo  "Rating : " . $row['s_rating'] . "<br />";
							echo  "Genre : " . $row['s_genre'] . "<br />";
							echo "</div>";
  	     	               	echo "<div class='cartire-grid-cartinfo'>";
							echo  "<span>"."Price : $" . $row['s_price'] . "</span><br />";
							if ($_SESSION['sess_type']!='admin') {
								echo "<a href='check.php?songID=" . $row['song_id'] . "'>Add to Cart</a>";
							}							
							echo "</div>";
      	                 	echo "<div class='clear'></div>";
      	                	echo "</div>";
       		             	echo "</div>";
					}
					?>
				</div>
                <div class="clear"> </div>
                <div class='cartire-grid-cartinfo'>
                </div>
        <?php 
	if ($artist != "") {
    	$query = "SELECT songs.s_title
    	FROM songs
    	INNER JOIN albums ON albums.album_id = songs.album_id    
		INNER JOIN artists ON artists.artist_id = albums.artist_id AND artists.a_name = '$artist'
		INNER JOIN album_image ON album_image.album_id = albums.album_id
		WHERE songs.availability = 'yes'";
	}

	else if ($album != "") {
    	$query = "SELECT songs.s_title
    	FROM songs
    	INNER JOIN albums ON albums.album_id = songs.album_id AND albums.a_title = '$album'
		INNER JOIN artists ON artists.artist_id = albums.artist_id
		INNER JOIN album_image ON album_image.album_id = albums.album_id
		WHERE songs.availability = 'yes'";
	}

	else {
    	$query = "SELECT songs.s_title
    	FROM songs
    	INNER JOIN albums ON albums.album_id = songs.album_id    
		INNER JOIN artists ON artists.artist_id = albums.artist_id
		INNER JOIN album_image ON album_image.album_id = albums.album_id
		WHERE songs.availability = 'yes'";
	}
        $result = mysqli_query($con, $query);

        $totalRecords = mysqli_num_rows($result);
        $totalPages = ceil($totalRecords / 5);
        
        echo "<div class='txt-center'><div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $page) {
                echo "<a href='productpage.php?page=" . $i . "' class='active'>" . $i . "</a> ";
            }
            else {
                echo "<a href='productpage.php?page=" . $i . "'>" . $i . "</a> ";
            }
        }
        echo "</div></div><br><br>";
        ?>
                </div>
                </div>

				<div class="clear"> </div>
			<div class="footer">
				<div class="wrap">
				<div class="section group">
				<div class="col_1_of_4 span_1_of_4">
					<h3>INFORMATION</h3>
					<ul>
						<li><a href="http://www.utdallas.edu">About us</a></li>
						<li><a href="feedback.php">Contact</a></li>
					</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4 footer-lastgrid">
					<h3>Get in touch</h3>
					<ul>
						<li><a href="https://www.facebook.com/utdallas/"><img src="images/facebook.png" title="facebook" /></a></li>
						<li><a href="https://twitter.com/ut_dallas?lang=en"><img src="images/twitter.png" title="Twiiter" /></a></li>
						<li><a href="https://plus.google.com/100814316624864549311"><img src="images/gpluse.png" title="Google+" /></a></li>
					</ul>
				</div>
			</div>
			</div>
		</div>
	</body>
</html>

