<?php
    session_start();
    if ( !isset($_SESSION['sess_username']) || trim($_SESSION['sess_username'])=='' || isset($_SESSION['sess_type']) )
	{	
		header('location:http://localhost/musicstore/login.html');
		exit();
	}
	
    $con = mysqli_connect("localhost", "root", "root", "music_store");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $username = $_SESSION['sess_username'];

    $query = "SELECT MAX(purchase_id) as max, p_date FROM purchases WHERE user_id = '$username';";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    $previousPurchaseID = $row['max'];
    $firstPurchaseDate = $row['p_date'];

    $query = "SELECT songs.s_title, songs.s_price, artists.a_name, albums.a_title, album_image.album_im, purchases.purchase_id, purchases.p_date
    FROM purchases
    INNER JOIN purchase_items ON purchases.purchase_id = purchase_items.purchase_id
    INNER JOIN songs ON songs.song_id = purchase_items.song_id
    INNER JOIN albums ON albums.album_id = songs.album_id
	INNER JOIN artists ON artists.artist_id = albums.artist_id
	INNER JOIN album_image ON album_image.album_id = albums.album_id
    WHERE purchases.user_id = '$username'
    ORDER BY purchase_id DESC;";
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
			
				<div class="content">
					<!--start-cartires-page---->
					<div class="Cartires">
                        <h5>Purchase History</h5>
                        <?php
                            echo "<div class='cartires-grids'>";
                            echo "<div class='cartire-grid'>";
                            echo "<h3>Purchase Date: " . $firstPurchaseDate . "</h3>";
                            echo "<h3>Order Number: " . $previousPurchaseID . "</h3><br>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $currentPurchaseID = $row['purchase_id'];
                                if ($currentPurchaseID == $previousPurchaseID) {
                                    echo "<div class='cartire-grid-img'>";
									echo '<img class="history" src="data:image/jpeg;base64,' . base64_encode($row['album_im'] ) . '"/>';	
                                    echo "</div>";
                                    echo "<div class='cartire-grid-info'>";
                                    echo "<h3>Title: " . $row['s_title'] . "</h3>";
                                    echo "<h3>Artist: " . $row['a_name'] . "</h3>";
                                    echo "<h3>Album: " . $row['a_title'] . "</h3>";
                                    $total += $row['s_price'];
                                    $previousPurchaseID = $row['purchase_id'];
                                    echo "</div>";
                                    echo "<div class='cartire-grid-cartinfo'>";
                                    echo "<h3>$" . number_format($row['s_price'], 2) . "</h3>";
                                    echo "</div>";
                                    echo "<div class='clear'></div>";
                                }
                                else {
                                    echo "<div class='cartire-grid-cartinfo'>";
                                    echo "Total: $" . number_format($total, 2);
                                    echo "</div><br><br>";
                                    $total = 0;
                                    echo "</div>";
                                    echo "<div class='cartire-grid'>";
                                    echo "<h3>Purchase Date: " . $row['p_date'] . "</h3>";
                                    echo "<h3>Order Number: " . $row['purchase_id'] . "</h3><br>";
                                    echo "<div class='cartire-grid-img'>";
									echo '<img class="history" src="data:image/jpeg;base64,' . base64_encode($row['album_im'] ) . '"/>';	
                                    echo "</div>";
                                    echo "<div class='cartire-grid-info'>";
                                    echo "<h3>Title: " . $row['s_title'] . "</h3>";
                                    echo "<h3>Artist: " . $row['a_name'] . "</h3>";
                                    echo "<h3>Album: " . $row['a_title'] . "</h3>";
                                    $total = $row['s_price'];
                                    $previousPurchaseID = $row['purchase_id'];
                                    echo "</div>";
                                    echo "<div class='cartire-grid-cartinfo'>";
                                    echo "<h3>$" . number_format($row['s_price'], 2) . "</h3>";
                                    echo "</div>";
                                    echo "<div class='clear'></div>";                        
                                }
                            }
                            echo "<div class='cartire-grid-cartinfo'>";
                            echo "Total: $" . number_format($total, 2);
                            echo "</div><br><br>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div></div><br><br>";
                        ?>
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
