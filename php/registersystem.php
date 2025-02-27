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

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $checkUserRegis = "SELECT * FROM users WHERE firstname = '$firstname' AND lastname = '$lastname'";
    $checkResult = mysqli_query($connect, $checkUserRegis);

    if(mysqli_num_rows($checkResult) > 0) {
        echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'you have a account already, please sign in',
                                customClass: {
                                    title: 'swal-custom-font',
                                    popup: 'swal-custom-font',
                                    confirmButton: 'swal-custom-font'
                                }
                            }).then((result) => {
                                if(result.isConfirmed) {
                                    window.location.href = '../signin.php';
                                }
                            });
                        });
                    </script>";
    } else {
        $checkUsername = "SELECT * FROM users WHERE username = '$username'";
        $checkResultCheckUsername = mysqli_query($connect, $checkUsername);

        if(mysqli_num_rows($checkResultCheckUsername) > 0) {
            echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'this username is uesd already, please use another username',
                                customClass: {
                                    title: 'swal-custom-font',
                                    popup: 'swal-custom-font',
                                    confirmButton: 'swal-custom-font'
                                }
                            }).then((result) => {
                                if(result.isConfirmed) {
                                    window.location.href = '../register.php';
                                }
                            });
                        });
                    </script>";
        } else {
            $Insert = "INSERT INTO users (firstname, lastname, username, password, role) VALUES ('$firstname', '$lastname', '$username', '$password', 'users')";
            $resultInsert = mysqli_query($connect, $Insert);

            if($resultInsert) {
                echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully',
                                text: 'you registered successfully, please sign in',
                                customClass: {
                                    title: 'swal-custom-font',
                                    popup: 'swal-custom-font',
                                    confirmButton: 'swal-custom-font'
                                }
                            }).then((result) => {
                                if(result.isConfirmed) {
                                    window.location.href = '../signin.php';
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
                                text: 'Something went wrong, please try agian',
                                customClass: {
                                    title: 'swal-custom-font',
                                    popup: 'swal-custom-font',
                                    confirmButton: 'swal-custom-font'
                                }
                            }).then((result) => {
                                if(result.isConfirmed) {
                                    window.location.href = '../register.php';
                                }
                            });
                        });
                    </script>";
            }
        }
    }
?>