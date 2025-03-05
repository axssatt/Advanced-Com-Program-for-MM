<?php
    session_start();
    require_once "php/config.php";
    if(!isset($_SESSION['id'])) {
        header("location= index.php");
    }
    $userID = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php"; ?>
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col col-md-1 col-lg-1">

            </div>
            <div class="col-12 col-md-1 col-lg-10">
                <div class="my-3 text-center">
                    <h2><?= $_SESSION['firstname'] ?>'s notifications</h2>
                </div>
                <?php
                    $notificationQuery = "SELECT * FROM notifications WHERE userID = '$userID'";
                    $result = mysqli_query($connect, $notificationQuery);

                    if(mysqli_num_rows($result) == 0) {
                ?>
                <div class="text-center">
                    <img src="material/bell.png" width="100px" height="100px" class="mb-2">
                    <p class="fs-5">You don’t have any new notifications.</p>
                </div>
                <?php } else { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Message</td>
                                <td style="width: 200px;">Time</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($noti = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $noti['message']; ?></td>
                                <td><?= $noti['updateTime']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
            <div class="col col-md-1 col-lg-1">

            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <?php include_once "footer.php"; ?>
</body>
</html>