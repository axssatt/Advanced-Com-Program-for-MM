<?php
    session_start();
    require_once "php/config.php";
    $userID = $_SESSION['id'];

    $queryCount = "SELECT * FROM cart LEFT JOIN goods ON item_id = goods_id WHERE user_id = '$userID'";
    $result = mysqli_query($connect, $queryCount);

    $final_price = 0; // Initialize final price

    if(isset($_GET['del'])) {
        $id = $_GET['del'];
        $deleteQuery = "DELETE FROM cart WHERE order_id = '$id'";
        $deleteResult = mysqli_query($connect, $deleteQuery);

        if($deleteResult) {
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
    <title>Cart</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body>
    <?php include_once "navbar.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-1 col-lg-1">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
            <div class="col-12 col-md-10 col-lg-10">
                <div class="row my-3">
                    <h2 class="text-center">Cart</h2>
                    <?php if(mysqli_num_rows($result) !== 0) { ?>
                    <div class="table-reponsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name of menu</th>
                                    <th>Quantity</th>
                                    <th>Unit price (฿)</th>
                                    <th>Total price (฿)</th>
                                    <th style="width: 100px;">Edit</th>
                                    <th style="width: 100px;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($allMenu = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $allMenu['name']; ?></td>
                                    <td><?= $allMenu['qty']; ?></td>
                                    <td><?= $allMenu['price']; ?></td>
                                    <td><?php echo number_format($itemPrice = $allMenu['qty'] * $allMenu['price'], 2); ?></td>
                                    <?php $final_price += $itemPrice; // Accumulate item prices ?>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modal<?= $allMenu['order_id']; ?>">
                                            Edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal<?= $allMenu['order_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="php/editQuantityCart.php" method="post">
                                                            <div class="mb-2">
                                                                <label for="nameMenu">Menu name</label>
                                                                <input type="text" name="name" id="nameMenu" disabled value="<?= $allMenu['name']; ?>" class="form-control">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="numberInput" class="form-label">Quantity</label>
                                                                <div class="input-group">
                                                                    <button class="btn btn-danger" id="btnMinus<?= $allMenu['order_id']; ?>" type="button">−</button>
                                                                    <input type="number" id="numberInput<?= $allMenu['order_id']; ?>" class="form-control text-center" value="<?= $allMenu['qty']; ?>" min="0" name="qty">
                                                                    <input type="hidden" name="orderID" value="<?= $allMenu['order_id']; ?>">
                                                                    <button class="btn btn-success" id="btnPlus<?= $allMenu['order_id']; ?>" type="button">+</button>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="price">Unit price (฿)</label>
                                                                <input type="text" name="unitprice" id="price" value="<?= $allMenu['price'] ?>" disabled class="form-control">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="reset" value="Cancel" class="btn btn-danger">
                                                        <input type="submit" value="Save Changes" class="btn btn-warning">
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="cart.php?del=<?= $allMenu['order_id']; ?>" class="btn btn-danger w-100 delete-btn">Delete</a></td>
                                </tr>
                                
                                <?php } ?>
                                <tr>
                                <td colspan="3" align="center">Total : </td>
                                    <td colspan="1"><?php echo number_format($final_price, 2); ?></td> <!-- Display final price -->
                                    <td colspan="2"><a href="orderSum.php" class="btn btn-success w-100">Confirm</a></td>
                                </tr>
                                <?php } else {   ?>
                                        <div class="text-center">
                                            <img src="material/shopping.png" width="200px" height="200px" class="mt-3">
                                            <p class="fs-4">Your cart is currently empty</p>
                                            <a href="menu.php" class="fs-6">Explore our menu and add your favorite items!</a>
                                        </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col col-md-1 col-lg-1">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
    <script src="js/bootstrap.bundle.js"></script>
    <script>
        // Use event delegation to handle button clicks dynamically for each modal
        document.addEventListener("DOMContentLoaded", function () {
            const btnPlusElements = document.querySelectorAll('[id^="btnPlus"]');
            const btnMinusElements = document.querySelectorAll('[id^="btnMinus"]');
            const inputElements = document.querySelectorAll('[id^="numberInput"]');

            btnPlusElements.forEach((btnPlus, index) => {
                btnPlus.addEventListener("click", function () {
                    let input = inputElements[index];
                    input.value = parseInt(input.value || 0) + 1;
                });
            });

            btnMinusElements.forEach((btnMinus, index) => {
                btnMinus.addEventListener("click", function () {
                    let input = inputElements[index];
                    if (parseInt(input.value) > 0) {
                        input.value = parseInt(input.value) - 1;
                    }
                });
            });
        });
    </script>
</body>
</html>