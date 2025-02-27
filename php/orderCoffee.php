<?php
    session_start();
    require_once "config.php";
    $userID = $_SESSION['id'];
    $itemID = $_POST['itemID'];
    $qty = $_POST['qty'];

    if(isset($_POST['cart'])) {
        $query = "INSERT INTO cart (user_id, item_id, qty) VALUES ('$userID', '$itemID', '$qty')";
        $result = mysqli_query($connect, $query);

        if($result) {
            echo "<script>alert('Add order to cart already'); window.location = '../cart.php'</script>";
        } else {
            echo "<script>alert('Can't add order to cart, please try agian'); window.location = '../menu.php'</script>";
        }
    } else {

    }
?>