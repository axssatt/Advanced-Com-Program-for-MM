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

    $quantity = $_POST['qty'];
    $orderID = $_POST['orderID'];

    $updateQuery = "UPDATE cart SET qty = '$quantity' WHERE order_id = '$orderID'";
    $result = mysqli_query($connect, $updateQuery);

    if($result){
        echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully',
                        text: 'Your item quantity has been updated successfully!',
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
                        title: 'Oops...',
                        text: 'This item quantity cannot be changed at this moment, please try again',
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
    }
?>