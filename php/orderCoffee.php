<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .swal-custom-font {
            font-family: 'Poppins', serif !important;
        }
    </style>
</head>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "config.php";
    $userID = $_SESSION['id'];
    $itemID = $_POST['itemID'];
    $qty = $_POST['qty'];

    if(isset($_POST['cart'])) {
        $query = "INSERT INTO cart (user_id, item_id, qty) VALUES ('$userID', '$itemID', '$qty')";
        $result = mysqli_query($connect, $query);

        if($result) {
            echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Add order to cart successfully',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../cart.php';
                                    }
                                });
                            });
                    </script>";
        } else {
            echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oop...',
                                    text: 'Can not add the order to cart, please try agian',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../menu.php';
                                    }
                                });
                            });
                    </script>";
        }
    } 
    if(isset($_POST['order'])){
        $menuName = $_POST['menuName'];
        $query = "INSERT INTO orders (userID, itemID, qty, `status`) VALUES ('$userID', '$itemID', '$qty', 'processing')";
        $result = mysqli_query($connect, $query);

        if($result) {
            $notiMessage = "You have a new order! $menuName is now ready to be prepared";
            $addNotiMessage = "INSERT INTO notificationAdmin (`text`, userID, `status`) VALUES ('$notiMessage', '$userID', 'Unread')";
            $resultAddNoti = mysqli_query($connect, $addNotiMessage);

            if($resultAddNoti) {
                echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'something ka?',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../orderCon.php';
                                    }
                                });
                            });
                    </script>";
            } else {
                echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oop...',
                                    text: 'Can not add the order, please try agian',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../menu.php';
                                    }
                                });
                            });
                    </script>";
            }
        } else {
            echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oop...',
                                    text: 'Can not add the order, please try agian',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../menu.php';
                                    }
                                });
                            });
                    </script>";
        }
    }
?>