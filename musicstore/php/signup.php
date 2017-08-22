<?php
//session_start();

//if($_SERVER["REQUEST_METHOD"]=="POST")
//{
	$firstname = htmlspecialchars($_POST['user_firstname']);
	$lastname = htmlspecialchars($_POST['user_lastname']);
	$email = htmlspecialchars($_POST['user_email']);
	$username = htmlspecialchars($_POST['user_username']);
	$password = $_POST['user_password'];
		
	$con = mysqli_connect("localhost","root","root","music_store");
	if(mysqli_connect_errno())
  	{
  			echo "Database Connection Failed";
  			exit();
  	}

  	//sha256 hashing of the password

    $hash = password_hash($password, PASSWORD_BCRYPT);

  	$sql = "INSERT INTO users (user_id, u_firstName, u_lastName, u_email, u_password) VALUES ('$username','$firstname','$lastname','$email','$hash'); ";

  	mysqli_query($con,$sql);

    echo "Account Created"; 
  	
  	//mysqli_close($con);
//}

?>