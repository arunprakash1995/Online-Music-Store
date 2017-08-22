<?php
//session_start();

//if($_SERVER["REQUEST_METHOD"]=="POST")
//{
	$oldadmin = htmlspecialchars($_POST['old_admin']);
	$oldpass = htmlspecialchars($_POST['old_pass']);
	$newadmin = htmlspecialchars($_POST['new_admin']);
	$newpass = $_POST['new_pass'];
		
	$con = mysqli_connect("localhost","root","root","music_store");
	if(mysqli_connect_errno())
  	{
  			echo "Database Connection Failed";
  			exit();
  	}

    
  	//verify existing admin
  $checkadmin = " SELECT admin_id, admin_pass FROM admin WHERE admin_id ='$oldadmin' ";

  $query=mysqli_query($con,$checkadmin);

  if(mysqli_num_rows($query)==0)
  {
    echo "Incorrect entry";
    exit();
  }

  $userData = mysqli_fetch_array($query,MYSQLI_ASSOC);

  if(!password_verify( $oldpass, $userData['admin_pass'])) //incorrect password
  {
    //header('Location:login.html');
    echo "Incorrect entry";
    exit();
  }

  

    $hash = password_hash($newpass, PASSWORD_BCRYPT);

  	$sql = "INSERT INTO admin (admin_id, admin_pass) VALUES ('$newadmin','$hash'); ";

  	mysqli_query($con,$sql);

    echo "Account Created"; 
  	
    //mysqli_close($con);
//}

?>