<?php
    require_once "php/config.php";
    session_start();
    if($_SESSION['role'] !== "admin") {
        header("location: index.php");
    }

    if(isset($_GET['del'])) {
        $id = $_GET['del'];
        $deleteQuery = "DELETE FROM users WHERE user_id = '$id'";
        $result = mysqli_query($connect, $deleteQuery);

        if($result) {
            echo "<script>alert('This user has been deleted successfully');</script>";
            header("refresh:1; url=manage_users.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage users</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include_once "navbar.php" ?>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col col-md-1 col-lg-2">
            
            </div>
            <div class="col-12 col-md-10 col-lg-8">
                <p class="fs-5 text-center">Manage Users</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Role</th>
                                <th style="width: 100px;">Edit</th>
                                <th style="width: 100px;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM users";
                                $result = mysqli_query($connect, $query);

                                if(mysqli_num_rows($result) >= 1) {
                                    while ($user = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?= $user['firstname']; ?></td>
                                    <td><?= $user['lastname']; ?></td>
                                    <td><?= $user['role']; ?></td>
                                    <td><a href="updateMenu.php?id=<?= $user['user_id']; ?>" class="btn btn-warning w-100">Edit</a></td>
                                    <td><a href="manage_users.php?del=<?= $user['user_id']; ?>" data-id="<?= $user['user_id']; ?>" class="btn btn-danger w-100 delete-btn">Delete</a></td>
                                </tr>
                            <?php } } ?>
                            <tr>
                                <td colspan="5" align="center"><a href="createMenu.php" class="btn btn-primary w-100">Add menu</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col col-md-1 col-lg-2">
                
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
    <script>
        $('.delete-btn').click(function(e) {
            var goodsID = $(this).data('id');
            e.preventDefault();
            deleteConfirm(goodsID);
        })

        function deleteConfirm(goodsID) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#47663B",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it",
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            url: 'manage_users.php',
                            type: 'GET',
                            data: 'del=' + goodsID
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'Success',
                                text: 'This user deleted successfully',
                                icon: 'success'
                            }).then(() => {
                                document.location.href = 'manage_users.php';
                            })
                        })
                        .fail(function() {
                            Swal.fire({
                                title: 'Oops...',
                                text: 'Something went wrong with ajax',
                                icon: 'error'
                            });
                            window.location.reload();
                        })
                    })
                }
            })
        }
    </script>
</body>
</html>