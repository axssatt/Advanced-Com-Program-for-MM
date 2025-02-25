<?php
    require_once "php/config.php";
    session_start();
    if($_SESSION['role'] !== "admin") {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Mugs</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php" ?>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col col-md-1 col-lg-2">
            
            </div>
            <div class="col-12 col-md-10 col-lg-8">
                <p class="fs-5 text-center">Manage Mugs</p>
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
                                $query = "SELECT * FROM mugs";
                                $result = mysqli_query($connect, $query);

                                if(mysqli_num_rows($result) >= 1) {
                                    while ($menu = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?= $menu['name']; ?></td>
                                    <td><a href="updateMenu.php?id=<?= $menu['mugs_id']; ?>" class="btn btn-warning w-100">Edit</a></td>
                                    <td><a href="deleteMenu.php?id=<?= $menu['mugs_id']; ?>" class="btn btn-danger w-100">Delete</a></td>
                                </tr>
                            <?php } } ?>
                            <tr>
                                <td colspan="3" align="center"><a href="createMug.php" class="btn btn-primary w-100">Add mugs</a></td>
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
</body>
</html>