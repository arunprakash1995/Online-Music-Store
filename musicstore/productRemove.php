<?php
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$a_title = $_POST['a_title'];
		$avail = 'no';
		
		$con = mysqli_connect('localhost','root','root','music_store');
			if(!$con) {
				header("Location: error.html");
			}

		/*To Get Album ID */
		$sql="SELECT album_id FROM albums WHERE a_title='".$a_title."'";
		$result = mysqli_query($con,$sql);
		$row = $result->fetch_assoc();
		$album_id = $row['album_id'];

		/*To Get the song IDs*/
		$sql="SELECT * FROM songs WHERE album_id='".$album_id."'";
		$result = mysqli_query($con,$sql);
			
		while($row = mysqli_fetch_assoc($result)){
			$song_id = $row['song_id'];
			/*To Delete the song from song Table*/
				$sql="UPDATE songs SET availability='".$avail."' WHERE song_id='".$song_id."'";
				$resultnew = mysqli_query($con,$sql);
		}

		/*To Delete Album from Album Table */
		  $sql="UPDATE albums SET availability='".$avail."' WHERE album_id='".$album_id."'";
		  $result = mysqli_query($con,$sql);


		mysqli_close($con);
		header('Location: admin.php');

	}
?>