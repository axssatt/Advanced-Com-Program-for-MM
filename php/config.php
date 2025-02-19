<?php

$connect = mysqli_connect("localhost", "root", "", "coffee_shop");

if($connect->connect_error) {
    die("connection failed" . $connect->error);
}

?>