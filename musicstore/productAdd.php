<?php
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$a_title = $_POST['a_title'];
		$a_name = $_POST['a_name'];
		$a_genre = $_POST['a_genre'];
		$a_rating = $_POST['a_rating'];
		$album_im = $_POST['album_im'];
		$artist_im = $_POST['artist_im'];
		$number = $_POST['number'];
		$avail= $_POST['avail'];
		$album_id = "";
		$artist_id= "";
		$SongTitle = array();
		$SongPrice = array();
		$SongYear = array();
		$SongGenre = array();
		$SongRating = array();
		$s_id = array();
		
		
		for($i=0 ; $i < $number; ++$i){

			$SongTit = $_POST["SongTitle".$i];
			$SongPri = $_POST["SongPrice".$i];
			$SongYr = $_POST["SongYear".$i];
			$SongGen = $_POST["SongGenre".$i];
			$SongRat = $_POST["SongRating".$i];
			array_push($SongTitle, $SongTit );
			array_push($SongPrice, $SongPri);
			array_push($SongYear, $SongYr);
			array_push($SongGenre, $SongGen);
			array_push($SongRating, $SongRat);
		}
		
		$con = mysqli_connect('localhost','root','root','music_store');
			if(!$con) {
				die('Server Error');
			}

		$sql = "SELECT * FROM albums WHERE a_title = '".$a_title."'";
		$result = mysqli_query($con,$sql);



		if ($result->num_rows > 0){
			

			$row = $result->fetch_assoc();
			$album_id = $row['album_id'];

			/*Populate the artists Table*/
			$sql="UPDATE artists SET a_genre = '".$a_genre."' WHERE a_name = '".$a_name."'";
			$result = mysqli_query($con,$sql);

			/*To get the artist ID*/
			$sql="SELECT artist_id FROM artists WHERE a_name = '".$a_name."'";
			$result = mysqli_query($con,$sql);
			$row= $result->fetch_assoc();
			$artist_id= $row['artist_id'];


			/*populate the Albums Table*/
			$sql="UPDATE albums SET a_title = '".$a_title."', a_rating = '".$a_rating."', artist_id = '".$artist_id."',availability= '".$avail."' WHERE album_id = '".$album_id."'" ;
			$result = mysqli_query($con,$sql);
	

				if(count($_FILES) > 0) {

				if(is_uploaded_file($_FILES['album_im']['tmp_name'])) {
				$imgData =addslashes(file_get_contents($_FILES['album_im']['tmp_name']));

				$imageProperties = getimageSize($_FILES['album_im']['tmp_name']);

				$sql="UPDATE album_image SET album_im = '".$imgData."' WHERE album_id = '".$album_id."'" ;
			    $result = mysqli_query($con,$sql);
			    }
			}	

			/*To Get the song IDs*/
			$sql="SELECT * FROM songs WHERE album_id='".$album_id."'";
			$result = mysqli_query($con,$sql);

			
			while($row = mysqli_fetch_assoc($result)){
			array_push($s_id,$row['song_id']);
			
			}

			$i=0;
			/*To Populate Songs Table*/
			foreach ($s_id as $song_id) {
			$SongTit = $SongTitle[$i];
			$SongPri = $SongPrice[$i];
			$SongYr = $SongYear[$i];
			$SongGen = $SongGenre[$i];
			$SongRat = $SongRating[$i];

			$sql="UPDATE songs SET s_title= '".$SongTit."', s_price= '".$SongPri."', s_year= '".$SongYr."', s_genre= '".$SongGen."', s_rating= '".$SongRat."', album_id= '".$album_id."', availability= '".$avail."' WHERE  song_id='".$song_id."'";
			$result = mysqli_query($con,$sql);
			++$i;
			}

			for(;$i<$number;++$i){

			$SongTit = $SongTitle[$i];
			$SongPri = $SongPrice[$i];
			$SongYr = $SongYear[$i];
			$SongGen = $SongGenre[$i];
			$SongRat = $SongRating[$i];

			$sql="INSERT INTO songs (song_id, s_title, s_price, s_year, s_genre, s_rating, album_id, availability) VALUES (NULL, '".$SongTit."', '".$SongPri."', '".$SongYr."','".$SongGen."', '".$SongRat."', '".$album_id."','".$avail."')";
			$result = mysqli_query($con,$sql);

			}
			

		}

		else{


		/*Populate the artists Table*/
		if(count($_FILES) > 0) {

		if(is_uploaded_file($_FILES['artist_im']['tmp_name'])) {

		$imgData1 =addslashes(file_get_contents($_FILES['artist_im']['tmp_name']));

		$imageProperties1 = getimageSize($_FILES['artist_im']['tmp_name']);
		$sql="INSERT INTO artists (artist_id, a_name, a_genre,artist_im) VALUES (NULL, '".$a_name."', '".$a_genre."','".$imgData1."')";
		$result = mysqli_query($con,$sql);
		}
		}

		/*To Get Artist Id*/
		$sql="SELECT artist_id FROM artists WHERE a_name='".$a_name."'";
		$result = mysqli_query($con,$sql);
		$row = $result->fetch_assoc();
		$artist_id = $row['artist_id'];
		

		/*populate the Albums Table*/
		$sql="INSERT INTO albums (album_id, a_title, a_rating, artist_id, availability) VALUES (NULL, '".$a_title."', '".$a_rating."', '".$artist_id."','".$avail."')";

		$result = mysqli_query($con,$sql);

		/*To Get Album ID */
		$sql="SELECT album_id FROM albums WHERE a_title='".$a_title."'";
		$result = mysqli_query($con,$sql);
		$row = $result->fetch_assoc();
		$album_id = $row['album_id'];

		/*Popupate the Albums Image Table*/
		if(count($_FILES) > 0) {

			if(is_uploaded_file($_FILES['album_im']['tmp_name'])) {

			$imgData =addslashes(file_get_contents($_FILES['album_im']['tmp_name']));

			$imageProperties = getimageSize($_FILES['album_im']['tmp_name']);


		$sql="INSERT INTO album_image (album_id, album_im) VALUES ('".$album_id."', '".$imgData."')";
		$result = mysqli_query($con,$sql);
		}
		}
		

		/*To Populate Songs Table*/
		for($i=0 ; $i < $number; ++$i){

			$SongTit = $SongTitle[$i];
			$SongPri = $SongPrice[$i];
			$SongYr = $SongYear[$i];
			$SongGen = $SongGenre[$i];
			$SongRat = $SongRating[$i];
			
		$sql="INSERT INTO songs (song_id, s_title, s_price, s_year, s_genre, s_rating, album_id, availability) VALUES (NULL, '".$SongTit."', '".$SongPri."', '".$SongYr."','".$SongGen."', '".$SongRat."', '".$album_id."','".$avail."')";
		$result = mysqli_query($con,$sql);
		}

		
	 }
	 mysqli_close($con);

	}
	header('Location: admin.php');
?>