<?php
session_start();

				
				$title = array();
    			$price= array();
    			$year= array();
    			$rating= array();
    			$genre= array();
				$image= array();
				$artist= array();
				$availability = array();
	$product = $_GET['product'];
	$category = $_GET['category'];
	$con = mysqli_connect('localhost','root','root','music_store');
			if(!$con) {
				header('Location: error.html');
			}
	if($product != ''){

		switch($category){

		case '1':$sql="SELECT * FROM songs S, albums A, album_image AI ,artists AL WHERE s_title LIKE '%".$product."%'  AND  S.album_id= A.album_id AND AI.album_id=S.album_id AND AL.artist_id=A.artist_id";
				$result = mysqli_query($con,$sql);
				if ($result->num_rows > 0) {
    				while($row = $result->fetch_assoc()) {
						array_push($title,$row['s_title']);
						array_push($price,$row['s_price']);
						array_push($year,$row['s_year']);
						array_push($rating,$row['s_rating']);
						array_push($genre,$row['s_genre']);
						array_push($image,$row['album_im']);
						array_push($artist,$row['a_name']);
						array_push($availability,$row['availability']);
    				}
   				}
   				else  {
						header('Location: error.html');
				}	
   				$_SESSION["category"]= $category;
				$_SESSION["s_title"] =$title;
    			$_SESSION["s_price"] =$price;
    			$_SESSION["s_year"] =$year;
    			$_SESSION["s_rating"]=$rating;
    			$_SESSION["s_genre"]=$genre;
				$_SESSION["album_im"] =$image;
				$_SESSION['a_name']=$artist;
				$_SESSION['availability']=$availability;
    			header('Location: productspage.php');
    			mysqli_close($con);
    			exit();
				break;	
			
		case '2':
				$sql="SELECT * FROM artists WHERE a_name LIKE '%".$product."%'";
				$result = mysqli_query($con,$sql);
				
				$artist_id = array();
				$a_name= array();
				$i=0;
				while($row = $result->fetch_assoc())
				{
					array_push($artist_id,$row['artist_id']);
					array_push($a_name,$row['a_name']);
				}
				//echo $artist_id;
				
				foreach ($artist_id as $art_id){
				$sql="SELECT * FROM albums WHERE artist_id='".$art_id."'";
				$result = mysqli_query($con,$sql);
				while($row = $result->fetch_assoc()) {
						$sqlone="SELECT * FROM songs s,album_image AI  WHERE s.album_id='".$row['album_id']."' AND AI.album_id= '".$row['album_id']."'";
						
						$res = mysqli_query($con,$sqlone);
						if ($res->num_rows > 0) {
    						while($rowone = $res->fetch_assoc()) {
    							array_push($title, $rowone['s_title']);
								array_push($price, $rowone['s_price']);
								array_push($year,$rowone['s_year']);
								array_push($rating, $rowone['s_rating']);
								array_push($genre,$rowone['s_genre']);
								array_push($image, $rowone['album_im']);
								array_push($artist,$a_name[$i]);
								array_push($availability,$rowone['availability']);
						 	}
						}
					}	
				++$i;
				}	
				
				$_SESSION["category"]= $category;
				$_SESSION["s_title"] =$title;
    			$_SESSION["s_price"] =$price;
    			$_SESSION["s_year"] =$year;
    			$_SESSION["s_rating"]=$rating;
    			$_SESSION["s_genre"]=$genre;
				$_SESSION["album_im"] =$image;
				$_SESSION['a_name']=$artist;
				$_SESSION['availability']= $availability;
    			header('Location: productspage.php');
    			mysqli_close($con);
    			exit();
				break;
		case '3':$sql="SELECT * FROM albums A, album_image AI ,artists AL, songs S WHERE a_title LIKE '%".$product."%'  AND  AI.album_id=A.album_id AND S.album_id=A.album_id AND AL.artist_id=A.artist_id";
		$result = mysqli_query($con,$sql);
				$title= array();
				$price=array();
				$year=array();
				$rating=array();
				$genre=array();
				$image=array();
				$artist=array();
				if ($result->num_rows > 0) {
    				while($rowone = $result->fetch_assoc()) {
							array_push($title, $rowone['s_title']);
							array_push($price, $rowone['s_price']);
							array_push($year,$rowone['s_year']);
							array_push($rating, $rowone['s_rating']);
							array_push($genre,$rowone['s_genre']);
							array_push($image, $rowone['album_im']);
							array_push($artist,$rowone['a_name']);
							array_push($availability, $rowone['availability']);
    				}
   				}
   				else  {
						header('Location: error.html');
				}
   				$_SESSION["category"]= $category;
				$_SESSION["s_title"] =$title;
    			$_SESSION["s_price"] =$price;
    			$_SESSION["s_year"] =$year;
    			$_SESSION["s_rating"]=$rating;
    			$_SESSION["s_genre"]=$genre;
				$_SESSION["album_im"] =$image;
				$_SESSION['a_name']=$artist;
				$_SESSION['availability']=$availability;
    			header('Location: productspage.php');
    			mysqli_close($con);
    			exit();
				break;	

	}
}
else  {
		header("Location: error.html");
	}	
?>
