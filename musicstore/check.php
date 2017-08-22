<?php
    session_start();
    if (empty($_SESSION['sess_username'])) {
        header("Location: login.html");
    }
    else {
        $con = mysqli_connect("localhost", "root", "root", "music_store");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $username = $_SESSION['sess_username'];
        $songID = $_GET['songID'];
        $cartID;

        $query = "SELECT cart_id FROM carts WHERE user_id = '$username';";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cartID = $row['cart_id'];
            }
        }
        else {
            $sql = "INSERT INTO carts (user_id) VALUES ('$username');";
            $result = mysqli_query($con, $sql);

            $query = "SELECT cart_id FROM carts WHERE user_id = '$username';";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $cartID = $row['cart_id'];
            }
        }

        $sql = "INSERT INTO cart_items (cart_id, song_id) VALUES ('$cartID', '$songID');";
        $result = mysqli_query($con, $sql);
        header("Location: cart.php");
    }
?>