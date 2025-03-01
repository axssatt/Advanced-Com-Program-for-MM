<?php  
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php"; ?>
        <div class="container-fluid my-3">
            <div class="row">
                <div class="col col-md-1 col-lg-2">

                </div>
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="row">
                        <h2 class="text-center mb-3">About Us</h2>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="card-body mt-3">
                                <div class="card-text">
                                    <p class="fs-6">672115054 Nattharawipa Wilimphodchaphornkul</p>
                                    <p class="fs-6">672115056 Punmanus Atama</p>
                                    <p class="fs-6">672115058 Saruta Kao-ian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-md-1 col-lg-2">

                </div>
            </div>
        </div>
    <?php include_once "footer.php"; ?>
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>