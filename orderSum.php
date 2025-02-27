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
    <title>Order Summary</title>
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
                                <?php while($allMenu = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $allMenu['name']; ?></td>
                                    <td><?= $allMenu['qty']; ?></td>
                                    <td><?= $allMenu['price']; ?></td>
                                    <td><?php echo number_format($itemPrice = $allMenu['qty'] * $allMenu['price'], 2); ?></td>
                                    <?php $final_price += $itemPrice; // Accumulate item prices ?>
                                </tr>
                                <?php } if(mysqli_num_rows($result) == 0) { ?>
                                    
                                <?php } else {   ?>
                                <tr>
                                    <td colspan="1">Discount :</td>
                                    <td colspan="3">
                                        <?php 
                                        function calculateDiscount($items) {
                                            $discount = 0;
                                        
                                            // Check if items contain coffee or non-coffee with dessert
                                            $containsCoffee = false;
                                            $containsDessert = false;
                                        
                                            foreach ($items as $item) {
                                                if (stripos($item, 'yes') !== false) {
                                                    $containsCoffee = true;
                                                } elseif (stripos($item, 'des') !== false) {
                                                    $containsDessert = true;
                                                }
                                            }
                                        
                                            // If coffee or non-coffee with dessert is found, apply discount
                                            if ($containsCoffee && $containsDessert) {
                                                $discount = 0.10; // 10% discount
                                            }
                                        
                                            return $discount;
                                        }
                                        
                                        // Example usage
                                        $items = ['yes', 'des'];
                                        $discountRate = calculateDiscount($items);
                                        
                                        if ($discountRate > 0) {
                                            echo "You have a discount of " . ($discountRate * 100) . "%.";
                                        } else {
                                            echo "No discount available.";
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">Total : </td>
                                    <td colspan="1">
                                        <?php 
                                            function caltotal($final_price, $discountRate) {
                                                $total = $final_price - ($final_price * $discountRate);
                                                return $total;
                                            }
                                        ?>
                                    </td> <!-- Display final price -->
                                    <td colspan="1"><a href="orderSum.php" class="btn btn-success w-100">Order Now</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
            </div>
            <div class="col col-md-1 col-lg-2">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>