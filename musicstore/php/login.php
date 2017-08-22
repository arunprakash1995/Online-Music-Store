<?php
session_start();
session_destroy();
session_start();

$username = htmlspecialchars($_POST['user_name']);
$password = $_POST['pass_word'];

$con = mysqli_connect("localhost","root","root","music_store");

$query = "SELECT user_id, u_password FROM users WHERE user_id = '$username'; ";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) == 0) 
{
	//header('Location:login.html');
	echo "Incorrect Credentials";
	exit();
}

$userData = mysqli_fetch_array($result,MYSQLI_ASSOC);
//$hash = password_hash($password, PASSWORD_BCRYPT);
//mysqli_close($con);

if(!password_verify( $password, $userData['u_password'])) //incorrect password
{
	//header('Location:login.html');
	echo "Incorrect Credentials";
	exit();
}
else
{
	session_regenerate_id();
	$_SESSION['sess_username'] = $userData['user_id'];

	
	
}

?>