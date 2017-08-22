<?php
session_start();
if ( ( !isset($_SESSION['sess_username']) || trim($_SESSION['sess_username'])=='') || !isset($_SESSION['sess_type']) )
{
	header('location:http://localhost/musicstore/admin.html');
	exit();
}
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
						<!--<li><a href="#">User login</a></li> -->
						<li><a href="#" class="user_tabs"><?php echo $_SESSION['sess_username']; ?></a></li>
						<?php
						if ($_SESSION['sess_type'] == 'admin') {
							echo "<li><a href='admin.php' id='admin_task' class='user_tab' > Admin Task</a></li>";
						}
						else{
							echo "<li><a href='history.php' class='user_tab'> Orders</a></li>";
						}
						?>
						<li><a href="php/logout.php" class="user_tab">Logout</a><li>
						<?php
						if ($_SESSION['sess_type'] != 'admin') {
							echo "<li><a href='cart.php' class='user_tab'>CART: <img src='images/cart.png' title='cart' /></a></li>";
						}
						?>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
			<div class="clear"> </div>
			<div class="top-nav">
				<ul>
					<li class="active1"><a href="index1.php">Home</a></li>
					<li><a href="albums.php">Albums</a></li>
					<li><a href="artists.php">Artists</a></li>
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
			
			<div style="color: black; background-color: white; font-size: 15pt">
				<div class="section group" >
	        		<div class="col_1_of_4 span_1_of_4">

	        		<form action='productRemove.php' method='post'>
	        			<fieldset>
	        				<legend>Product Details</legend>
	        					<p><label>Album Title</label>
	        					<input type='text' name='a_title'>
	        					</p>
   								<input type="submit" name="submit">
	        			</fieldset>
	        		</form>

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