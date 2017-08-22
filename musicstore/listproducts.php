<?php
session_start();
	$category= 2;
	$title = array();
	$price= array();
	$year= array();
	$rating= array();
	$genre= array();
	$image= array();
	$artist= array();
	$availability = array();
	$con = mysqli_connect('Localhost','root','root','music_store');
	if(!$con)
	{
		header("Location: error.html");
	}
	$sql = "SELECT * FROM songs";
	$result = mysqli_query($con,$sql);

	while($row = $result->fetch_assoc()){
								
			$sql1 = "SELECT album_im FROM album_image WHERE album_id = '".$row['album_id']."'";
			$result1 = mysqli_query($con,$sql1);
			$row1 = $result1->fetch_assoc();
			$album_im = $row1['album_im'];
							
			$sql3 = "SELECT artist_id FROM albums WHERE album_id = '".$row['album_id']."'";
			$result3 = mysqli_query($con,$sql3);
			$row3 = $result3->fetch_assoc();
							
			$sql2 = "SELECT a_name FROM artists WHERE artist_id = '".$row3['artist_id']."'";
			$result2 = mysqli_query($con,$sql2);
			$row2 = $result2->fetch_assoc();
			$a_name = $row2['a_name'];
							
			array_push($title, $row['s_title']);
			array_push($price, $row['s_price']);
			array_push($year,$row['s_year']);
			array_push($rating, $row['s_rating']);
			array_push($genre,$row['s_genre']);
			array_push($image, $album_im);
			array_push($artist,$a_name);
			array_push($availability,$row['availability']);
							
	}

	$_SESSION["category"]= $category;
	$_SESSION["s_title"] =$title;
	$_SESSION["s_price"] =$price;
	$_SESSION["s_year"] =$year;
	$_SESSION["s_rating"]=$rating;
	$_SESSION["s_genre"]=$genre;
	$_SESSION["album_im"] =$image;
	$_SESSION['a_name']=$artist;
	$_SESSION['availability'] = $availability;

	header("Location: productpage.php");

    mysqli_close($con);
   	exit();

 ?>  	
 