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
            header("refresh:1; url=manage_cofeeBeans.php");
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Beans</title>
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
                <h2 class="text-center mb-3">Coffee Beans</h2>
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
                                $query = "SELECT * FROM goods WHERE Coffee = 'bean'";
                                $result = mysqli_query($connect, $query);

                                if(mysqli_num_rows($result) >= 1) {
                                    while ($menu = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?= $menu['name']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $menu['goods_id']; ?>">
                                            Edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $menu['goods_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $menu['goods_id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel<?= $user['user_id']; ?>">Edit Coffeebeans</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="manage_coffeeBeans.php" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="userId" value="<?= $user['user_id']; ?>">
                                                            <div class="mb-2">
                                                                <label for="name" class="form-label">Cofeebeans Name</label>
                                                                <input type="text" name="name" id="name" class="form-control" value="<?= $menu['name']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="descriton" class="form-label">Description</label>
                                                                <input type="text" name="description" id="description" class="form-control" value="<?= $menu['description']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="price" class="form-label">Price</label>
                                                                <input type="text" name="price" id="price" class="form-control" value="<?= $menu['price']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="quantity" class="form-label">Quantity</label>
                                                                <input type="text" name="password" id="password" class="form-control" value="<?= $menu['quantity']; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="updateUser" class="btn btn-warning">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a data-id="<?= $menu['goods_id'];?>" href="manage_coffeeBeans.php?del=<?= $menu['goods_id']; ?>" class="btn btn-danger w-100 delete-btn">Delete</a></td>
                                </tr>
                            <?php } } ?>
                            <tr>
                                <td colspan="3" align="center"><a href="createCoffeeBeans.php" class="btn btn-primary w-100">Add Coffee Beans<a></td>
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
                                document.location.href = 'manage_coffeeBeans.php';
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