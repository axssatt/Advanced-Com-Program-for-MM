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

            $query = "INSERT INTO goods (`name`, `description`, price, quantity, Coffee, img) VALUES ('$name', '$description', '$price', '$quantity', 'bean', '".$fileName."')";
            $result = mysqli_query($connect, $query);

            if($result){
                echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully',
                                text: 'Add coffee bean successfully',
                                customClass: {
                                    title: 'swal-custom-font',
                                    popup: 'swal-custom-font',
                                    confirmButton: 'swal-custom-font'
                                }
                            }).then((result) => {
                                if(result.isConfirmed) {
                                    window.location.href = '../manage_coffeeBeans.php';
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
                                text: 'Can't add this coffee bean, please try agian',
                                customClass: {
                                    title: 'swal-custom-font',
                                    popup: 'swal-custom-font',
                                    confirmButton: 'swal-custom-font'
                                }
                            }).then((result) => {
                                if(result.isConfirmed) {
                                    window.location.href = '../createCoffeeBeans.php';
                                }
                            });
                        });
                    </script>";
            }
        }
    }
    
?>