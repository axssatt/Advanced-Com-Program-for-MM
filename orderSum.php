<?php
    session_start();
    require_once "php/config.php";
    $userID = $_SESSION['id'];

    $queryCount = "SELECT * FROM cart LEFT JOIN goods ON item_id = goods_id WHERE user_id = '$userID'";
    $result = mysqli_query($connect, $queryCount);

    $final_price = 0; // Initialize final price
    $hasDessert = false;
    $hasDrink = false;

    if(isset($_GET['status']) == "orderNow") {
        $queryCount = "SELECT * FROM ordernow LEFT JOIN goods ON item_id = good_id WHERE user_id = '$userID'";
        $result = mysqli_query($connect, $queryCount);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
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
            <div class="row">
                    <p class="text-center fs-1">Order Summary</p>
            </div>               
            <table class="table">
                            <thead>
                                <tr>
                                    <th>Name of menu</th>
                                    <th>Quantity</th>
                                    <th>Unit price (฿)</th>
                                    <th>Total price (฿)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="php/orderItem.php" method="post">
                                <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                                <?php 
                                    $index = 0;
                                    while($allMenu = mysqli_fetch_assoc($result)) { 
                                    if($allMenu['Coffee'] == 'des') {
                                        $hasDessert = true;
                                    }
                                    if($allMenu['Coffee'] == 'yes' || $allMenu['Coffee'] == 'no') {
                                        $hasDrink = true;
                                    }
                                ?>
                                <tr>
                                    <input type="hidden" name="items[<?php echo $index; ?>][goods_id]" value="<?php echo $allMenu['goods_id']; ?>">
                                    <input type="hidden" name="items[<?php echo $index; ?>][qty]" value="<?php echo $allMenu['qty']; ?>">
                                    <td><?= $allMenu['name']; ?></td>
                                    <td><?= $allMenu['qty']; ?></td>
                                    <td><?= $allMenu['price']; ?></td>
                                    <td><?php echo number_format($itemPrice = $allMenu['qty'] * $allMenu['price'], 2); ?></td>
                                    <?php $final_price += $itemPrice; // Accumulate item prices ?>
                                </tr>
                                <?php $index++; } if(mysqli_num_rows($result) == 0) { ?>
                                    
                                <?php } else {   ?>
                                <tr>
                                    <td colspan="1">Discount :</td>
                                    <td colspan="3">
                                        <?php if($hasDessert && $hasDrink) {
                                            echo "You have a discount of 10%.";
                                        } else {
                                            echo "No discount available.";
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">Total : </td>
                                    <td colspan="1">
                                        <?php if($hasDessert && $hasDrink) {
                                            $totalPrice = $final_price - ($final_price * 0.1);
                                            echo number_format($totalPrice, 2);
                                        } else {
                                            echo number_format($final_price, 2);
                                        }?>
                                    </td> <!-- Display final price -->
                                    <!-- form to send data to database -->
                                    <td colspan="1"><input type="submit" value="Order now" class="btn btn-success w-100"></td>
                                </tr>
                                <?php } ?>
                                </form>
                            </tbody>
                        </table>
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

<input type="hidden" name="items[<?php echo $index; ?>][product_id]" value="<?php echo $row['id']; ?>">