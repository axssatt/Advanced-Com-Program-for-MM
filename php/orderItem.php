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
require_once "config.php";

$items = $_POST['items'];
$userID = $_POST['userID'];

foreach ($items as $item) {
    $goodsID = $item['goods_id'];
    $qty = $item['qty'];

    $query = "INSERT INTO orders (userID, itemID, qty, `status`) VALUES ('$userID', '$goodsID', '$qty', 'processing')";
    $result = mysqli_query($connect, $query);
}

if($result) {
    $deleteCart = "DELETE FROM cart WHERE user_id = '$userID'";
    $resultDelete = mysqli_query($connect, $deleteCart);
    if($resultDelete){
        echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully',
                        text: 'Your order has been successfully placed!',
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
    }
} else {
    echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Something went wrong with your order. Please try again',
                        customClass: {
                            title: 'swal-custom-font',
                            popup: 'swal-custom-font',
                            confirmButton: 'swal-custom-font'
                        }
                    }).then((result) => {
                        if(result.isConfirmed) {
                            window.location.href = '../orderSum.php';
                        }
                    });
                });
            </script>";
}

?>