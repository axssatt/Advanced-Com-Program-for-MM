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

        if($deleteResult){
            echo "<script>alert('Deleted this order successfully'); window.location = 'cart.php'</script>";
        } else {
            echo "<script>alert('Can't delete this order, please try agian'); window.location = 'cart.php'</script>";
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
                    <p class="text-center fs-4">Cart</p>
                    <div class="table-reponsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name of menu</th>
                                    <th>Quantity</th>
                                    <th>Unit price (฿)</th>
                                    <th>Total price (฿)</th>
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
                                    <td><a href="cart.php?del=<?= $allMenu['order_id']; ?>" class="btn btn-danger w-100">Delete</a></td>
                                </tr>
                                <?php } if(mysqli_num_rows($result) == 0) { ?>
                                    
                                <?php } else {   ?>
                                <tr>
                                    <td colspan="3" align="center">Total : </td>
                                    <td colspan="1"><?php echo number_format($final_price, 2); ?></td> <!-- Display final price -->
                                    <td colspan="1"><a href="confirmOrder.php" class="btn btn-success w-100">Confirm</a></td>
                                </tr>
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
</body>
</html>