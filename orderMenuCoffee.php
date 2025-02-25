<?php 
    session_start();
    require_once "php/config.php";

    if(!isset($_SESSION['role'])) {
        echo "<script>alert('Please sign in first!'); window.location = 'signin.php'</script>";
    }

    $menuID = $_GET['id'];

    $query = "SELECT * FROM menu WHERE menu_id = '$menuID'";
    $result = mysqli_query($connect, $query);

    $menu = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-1 col-lg-2">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
            <div class="col-12 col-md-10 col-lg-8">
                <div class="row my-4">
                    <p class="text-center fs-5">Order menu</p>
                </div>
                <div class="row my-2">
                    <div class="card mb-5">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <img src="img-upload/<?= $menu['img'] ?>" class="img-fluid rounded-start">
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card-body">
                                    <p class="fs-5 mt-3"><?= $menu['name']; ?></p>
                                    <p style="font-size: 12px;"><?= $menu['description']; ?></p>
                                    <form action="php/orderCoffee.php" method="post">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label for="numberInput" class="form-label">Quantity</label>
                                                <div class="input-group">
                                                    <button class="btn btn-danger" id="btnMinus" type="button">−</button>
                                                    <input type="number" id="numberInput" class="form-control text-center" value="1" min="0">
                                                    <button class="btn btn-success" id="btnPlus" type="button">+</button>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="submit" value="Add to card" class="btn btn w-100" style="background-color: #47663B; color: #fff;margin-top: 32px;" name="card">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="submit" value="Order now" class="btn btn w-100" style="background-color: #EED3B1; color: #000;margin-top: 32px;" name="order">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-1 col-lg-2">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
    <script src="js/bootstrap.bundle.js"></script>
    <script>
            document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("numberInput");
            const btnMinus = document.getElementById("btnMinus");
            const btnPlus = document.getElementById("btnPlus");

            btnPlus.addEventListener("click", function () {
                input.value = parseInt(input.value || 0) + 1;
            });

            btnMinus.addEventListener("click", function () {
                if (parseInt(input.value) > 0) {
                    input.value = parseInt(input.value) - 1;
                }
            });
        });
    </script>
</body>
</html>