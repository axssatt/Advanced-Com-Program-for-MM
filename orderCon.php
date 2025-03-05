<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php"?>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-1 col-lg-2">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
            <div class="col-12 col-md-10 col-lg-8">
                <!-- เริ่มเขียนโค้ดตรงนี้เลยยย -->
                 <div class="row">
                 <p class="text-center mt-3 fs-1">Order Confirmed</p>
                 </div>
                 <div class="card text-white-3" style="background-color: #dcdcd4;">
                    <p class="text-center fs-4 mt-3 mb-3">THANK YOU! <br> FOR ORDER OUR PRODUCT<br>WISH YOUR DAISY BLOOM!</p>
                 </div>
                 <div class="row">
                    <p class="text-center">Continue Shopping?
                        <a href="index.php"><img src="material/shopping-cart_black.png" width="30px" height="30px" class="me-3 mt-1"></a>
                    </p> 
                 </div>
            </div>
            <div class="col col-md-1 col-lg-2">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>