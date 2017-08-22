<?php
		if(isset($_POST['add']))
		{
			$add = $_POST['add'];
			header('Location: productAddPage.php');
		}


		if(isset($_POST['remove']))
		{
			$remove = $_POST['remove'];
			header('Location: productRemovePage.php');
		}

		if(isset($_POST['update']))
		{
			header('Location: updateProductPage.php');
		}
		if(isset($_POST['list']))
		{
			header('Location: listproducts.php');
		}
		if(isset($_POST['feedback']))
		{
			header('Location: listFeedbacks.php');
		}
		
?>
