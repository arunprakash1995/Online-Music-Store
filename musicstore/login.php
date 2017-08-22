<?php
    session_start();
    
    $con=mysqli_connect("localhost","root","root","music_store");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $query = "SELECT user_id FROM users WHERE user_id = '$username' AND u_password = '$password';";
    $result = mysqli_query ($con, $query);

    if (empty($username) || empty($password) || $result->num_rows == 0)
    {
        header('Location: login.html');
        exit();
    }

    $_SESSION['sess_username'] = $username;
    header('Location: productpage.php');
?>