<?php
$a="";
$conn =mysqli_connect("localhost","root","root","hw4");
	
	if (!$conn) {
    die("Connection failed: " );
	} 
   $url = $_SERVER['REQUEST_URI'];
   $path = parse_url($url, PHP_URL_PATH);
	
	
   if($path == '/books')
   {
	$sql = "SELECT * FROM book";
	$result = mysqli_query($conn,$sql);    

	while ($row = mysqli_fetch_assoc($result)) {
	
    	$row_array[] = $row['book_id'];
    	$row_array[] = $row['title'];
    	$row_array[] = $row['year'];
    	$row_array[] = $row['price'];
    	$row_array[] = $row['category'];    
	}
   }

   else 
   {

   	$pathParameters = explode('/', trim($path, '/'));
   	$bookID = $pathParameters[1];
	$sql = "SELECT * FROM book B,Book_Authors BA,Authors A WHERE B.Book_id=BA.Book_id AND BA.Author_id=A.Author_id and B.Book_id='".$bookID."'";
	
	$result = mysqli_query($conn,$sql); 
	while ($row = mysqli_fetch_assoc($result)) 
	{
		$row_array[] = $row['title'];
		$row_array[] = $row['year'];
		$row_array[] = $row['price'];
		$row_array[] = $row['category'];
		$row_array[] = $row['author_name'];
	}
  }
  echo json_encode($row_array);
 ?>


