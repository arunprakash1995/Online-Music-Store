
<?php

$con = mysqli_connect("localhost","root","root","music_store");

if(isset($_POST['user_name']))
{
 $name=htmlspecialchars($_POST['user_name']);

 $checkdata=" SELECT user_id FROM users WHERE user_id='$name' ";

 $query=mysqli_query($con,$checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo "Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}

if(isset($_POST['user_email']))
{
 $emailId=htmlspecialchars($_POST['user_email']);

 $checkdata=" SELECT email FROM users WHERE email='$emailId' ";

 $query=mysqli_query($con,$checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo "Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}

?>