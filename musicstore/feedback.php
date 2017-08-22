<?php
session_start();

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
					<li><a href="listproducts.php">Songs</a></li>
					<?php
						if ($_SESSION['sess_type'] != 'admin') {
							echo "<li class='active1'><a href='feedback.php'>Feedback</a></li>";
						}
					?>	
					<div class="clear"> </div>
				</ul>
			</div>
			<!---end-top-header->
			<!-End-header-->
				<div class="content">
					<div class="contact">
						<div class="section group">				
				<div class="col span_1_of_3">
					<div class="contact_info">
			    	 	<h3>Find Us Here</h3>
			    	 		<div class="map">
					   			<iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/place/The+University+of+Texas+at+Dallas/@32.9857664,-96.752288,17z/data=!3m1!4b1!4m5!3m4!1s0x864c21ff895e4aa5:0xd9098b32e9aa1331!8m2!3d32.9857619!4d-96.7500993"></iframe><br><small><a href="https://www.google.com/maps/place/The+University+of+Texas+at+Dallas/@32.9857664,-96.752288,17z/data=!3m1!4b1!4m5!3m4!1s0x864c21ff895e4aa5:0xd9098b32e9aa1331!8m2!3d32.9857619!4d-96.7500993" style="color:#666;text-align:left;font-size:12px">View Larger Map</a></small>
					   		</div>
      				</div>
      			<div class="company_address">
				     	<h3>College Information :</h3>
						    	<p>The University of Texas at Dallas</p>
						   		<p>800 West Campbell Road</p>
						   		<p>Richardson, TX 75080</p>
				   		<p>Phone:(972) 883-2111</p>
				 	 	<p>Email: <span> assist@utdallas.edu</span></p>
				   		<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
				   </div>
				</div>				
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>Contact Us</h3>
					    <form action='contact.php' method='post'> 
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input type="text" value="" name="c_name" placeholder="eg.Jhon"></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="email" value="" name="c_email" placeholder="eg.Jhon@gmail.com"></span>
						    </div>
						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input type="tel" value="" name="c_number" placeholder="(919)2928221"></span>
						    </div>
						    <div>
						    	<span><label>COMMENTS</label></span>
						    	<span><textarea name="comment" placeholder="Type your opinion here"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="Submit"></span>
						  </div>
					    </form>
				    </div>
  				</div>				
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

