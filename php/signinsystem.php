<?php
    session_start();
    require_once "config.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) == 0) {
        echo "<script>alert('username or password is incorrect please try again'); window.location = '../index.php';</script>";
    } else {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['id'] = $row['user_id'];
        header("Location: ../index.php");
    }
?>