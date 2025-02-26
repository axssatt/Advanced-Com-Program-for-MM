<?php
    require_once "config.php";

    $imgDir = "../img-upload/";
    $fileName = basename($_FILES["picture"]["name"]);
    $imgFilePath = $imgDir . $fileName;
    $fileType = pathinfo($imgFilePath, PATHINFO_EXTENSION);

    $allowType = array('jpg', 'png', 'jpeg');
    if(in_array($fileType, $allowType)) {
        if(move_uploaded_file($_FILES['picture']['tmp_name'], $imgFilePath)) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];

            $query = "INSERT INTO goods (`name`, `description`, price, quantity, img, Coffee) VALUES ('$name', '$description', '$price', '$quantity', '".$fileName."', 'mug')";
            $result = mysqli_query($connect, $query);

            if($result){
                echo "<script>alert('add mug successfully!'); window.location = '../manage_mug.php';</script>";
            } else {
                echo "<script>alert(can not add mug into database, please try agian'); window.location = '../createMug.php';</script>";
            }
        }
    }
    
?>