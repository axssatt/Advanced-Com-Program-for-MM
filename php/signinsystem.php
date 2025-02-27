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

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) == 0) {
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry',
                    text: 'username or password is incorrect, please try agian',
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
        $row = mysqli_fetch_assoc($result);
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['id'] = $row['user_id'];
        header("Location: ../index.php");
    }
?>