
<?php

$con = mysqli_connect("localhost","root","root","music_store");

if(isset($_POST['user_name']))
{
 $name=htmlspecialchars($_POST['user_name']);

 $checkadmin=" SELECT admin_id FROM admin WHERE admin_id ='$name' ";

 $query=mysqli_query($con,$checkadmin);

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