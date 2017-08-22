<?php
session_start();

//echo $_SESSION['sess_username'];

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
					<li class="active1"><a href="artists.php">Artists</a></li>
					<li><a href="listproducts.php">Songs</a></li>
					<?php
						if ($_SESSION['sess_type'] != 'admin') {
							echo "<li><a href='feedback.php'>Feedback</a></li>";
						}
					?>
					<div class="clear"> </div>
				</ul>
			</div>
			<!---end-top-header-->
			<!---End-header-->
			</div>
			
				<div class="content">
					<div class="products-box">
					<div class="products">
					<div class="section group">
					<h5>Artists</h5>
				<?php

					$a_id = '';
					$a_title =  '';
					$a_rating = '';
					//$title = array();
					//$rating = array();

					$con = mysqli_connect('localhost','root','root','music_store');
					if(!$con){
						echo 'Server Error';
					}
						$sql = "SELECT * FROM artists";
						$result = mysqli_query($con,$sql);

						$count = 1;
						//$id = 0;

						while($row = $result->fetch_assoc()){

							$a_name = $row['a_name'];
							$a_genre = $row['a_genre'];
							$artist_im = $row['artist_im'];

							if(count == 6){
								echo '<div class="products-box">';
								echo '<div class="products">';
								echo '<div class="section group">';
								$count = 0;
							}

							echo '<div class="grid_1_of_5 images_1_of_5">';
							echo '<img class="album" src="data:image/jpeg;base64,' . base64_encode($artist_im) . '"/>';
							echo '<h3>'.$a_name.'</h3>';
							echo '<h4>'.$a_genre.'</h4>';
							echo '<div class="button"><a href="productpage.php?artist=' . $a_name . '">View Songs</a></div>';
						    echo '</div>';

						}

				?>
					<!--End-image-slider-->
			</div>
			</div>
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

