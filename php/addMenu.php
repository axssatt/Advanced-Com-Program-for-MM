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
            $category = $_POST['category'];

            $query = "INSERT INTO menu (`name`, `description`, price, quantity, Coffee, img) VALUES ('$name', '$description', '$price', '$quantity', '$category', '".$fileName."')";
            $result = mysqli_query($connect, $query);

            if($result){
                echo "<script>alert('add menu successfully!'); window.location = '../manage_menu.php';</script>";
            } else {
                echo "<script>alert(can not add menu into database, please try agian'); window.location = '../createMenu.php';</script>";
            }
        }
    }
    
?>