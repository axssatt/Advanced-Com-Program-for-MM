<?php
    require_once "php/config.php";
    session_start();
    if($_SESSION['role'] !== "admin") {
        header("location: index.php");
    }

    if(isset($_GET['del'])) {
        $id = $_GET['del'];
        $deleteQuery = "DELETE FROM goods WHERE goods_id = '$id'";
        $result = mysqli_query($connect, $deleteQuery);

        if($result) {
            echo "<script>alert('This menu has been deleted successfully');</script>";
            header("refresh:1; url=manage_menu.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu</title>
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
                <p class="fs-5 text-center">Manage Menu</p>
                <div class="table-reponsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th style="width: 100px;">Edit</th>
                                <th style="width: 100px;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM goods";
                                $result = mysqli_query($connect, $query);

                                if(mysqli_num_rows($result) >= 1) {
                                    while ($menu = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?= $menu['name']; ?></td>
                                    <td><a href="updateMenu.php?id=<?= $menu['goods_id']; ?>" class="btn btn-warning w-100">Edit</a></td>
                                    <td><a href="manage_menu.php?del=<?= $menu['goods_id']; ?>" data-id="<?= $menu['goods_id']; ?>" class="btn btn-danger w-100 delete-btn">Delete</a></td>
                                </tr>
                            <?php } } ?>
                            <tr>
                                <td colspan="3" align="center"><a href="createMenu.php" class="btn btn-primary w-100">Add menu</a></td>
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
                            url: 'manage_menu.php',
                            type: 'GET',
                            data: 'del=' + goodsID
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'Success',
                                text: 'This menu deleted successfully',
                                icon: 'success'
                            }).then(() => {
                                document.location.href = 'manage_menu.php';
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