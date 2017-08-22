<?php
	$c_name='';
	$c_email='';
	$c_number='';
	$comment='';

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$c_name= $_POST['c_name'];
		$c_email=$_POST['c_email'];
		$c_number=$_POST['c_number'];
		$comment=$_POST['comment'];
	
		$con = mysqli_connect('localhost','root','root','music_store');
		if(!$con){
			echo "Error";
		}
		$sql = "INSERT into FeedBack (f_id, c_name,  c_number, c_email,comment) VALUES (NULL, '".$c_name."', '".$c_number."', '".$c_email."','".$comment."')";
		$res = mysqli_query($con,$sql);

	}
	
	header('Location: index.html');
?>
