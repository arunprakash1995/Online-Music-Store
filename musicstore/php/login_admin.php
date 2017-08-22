<?php
session_start();
session_destroy();
session_start();

$username = htmlspecialchars($_POST['user_name']);
$password = $_POST['pass_word'];

$con = mysqli_connect("localhost","root","root","music_store");

$query = "SELECT admin_id, admin_pass FROM admin WHERE admin_id = '$username'; ";
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

if(!password_verify( $password, $userData['admin_pass'])) //incorrect password
{
	//header('Location:login.html');
	echo "Incorrect Credentials";
	exit();
}
else
{
	session_regenerate_id();
	$_SESSION['sess_username'] = $userData['admin_id'];
	$_SESSION['sess_type'] = 'admin';
	session_write_close();
	//echo "Correct";
	//header('Location:home.php');
	
}

?>