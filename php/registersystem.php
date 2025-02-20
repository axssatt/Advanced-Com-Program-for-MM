<?php
    require_once "config.php";

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $checkUserRegis = "SELECT * FROM users WHERE firstname = '$firstname' AND lastname = '$lastname'";
    $checkResult = mysqli_query($connect, $checkUserRegis);

    if(mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('you create a account already, please sign in')</script>";
    } else {
        $checkUsername = "SELECT * FROM users WHERE username = '$username'";
        $checkResultCheckUsername = mysqli_query($connect, $checkUsername);

        if(mysqli_num_rows($checkResultCheckUsername) > 0) {
            echo "<script></script>";
        } else {
            $Insert = "INSERT INTO users (firstname, lastname, username, password)";
        }
    }
?>