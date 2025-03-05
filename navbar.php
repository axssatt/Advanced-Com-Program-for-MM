<nav class="navbar navbar-expand-lg" style="background-color: #6F8C51;">
  <div class="container-fluid">
    <img src="material/img/logo-removebg-preview.png" width="45px" height="45px">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php" style="color: #FFF4F4;">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #FFF4F4;">
            Menu
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="menu.php">Menu</a></li>
            <li><a class="dropdown-item" href="coffeeBeans.php">Coffee Beans</a></li>
            <li><a class="dropdown-item" href="mugs.php">Mugs</a></li>
            <li><a class="dropdown-item" href="orders.php">Orders</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="aboutus.php" style="color: #FFF4F4;">About Us</a>
        </li>
        <?php if (isset($_SESSION['role'])) { ?>
          <?php if($_SESSION['role'] == "admin") { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #FFF4F4;">
                Admin Menu
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="manage_menu.php">Menu</a></li>
                <li><a class="dropdown-item" href="manage_coffeeBeans.php">Coffee Beans</a></li>
                <li><a class="dropdown-item" href="manage_mug.php">Mugs</a></li>
                <li><a class="dropdown-item" href="manage_orders.php">Orders</a></li>
                <li><a class="dropdown-item" href="manage_users.php">Users</a></li>
              </ul>
            </li>
          <?php } ?>
        <?php } ?>
      </ul>
      <form class="d-flex" role="search">
        <?php if(isset($_SESSION['firstname'])) { ?>
          <span class="navbar-text me-3" style="color: #FFF4F4;">
            Welcome, <?php echo $_SESSION['firstname']; ?>
          </span>
            <?php if(isset($_SESSION['role'])) { 
              if($_SESSION['role'] == 'users') {
            ?>
              <a href="notiUser.php?id=<?= $_SESSION['id'] ?>"><img src="material/notifications.png" width="30px" height="30px" class="me-3 mt-1"></a>
            <?php } else { ?>
              <a href="notiAdmin.php"><img src="material/notifications.png" width="30px" height="30px" class="me-3 mt-1"></a>
            <?php } ?>
            <a href="cart.php"><img src="material/shopping-cart.png" width="30px" height="30px" class="me-3 mt-1"></a>
            <a href="index.php?logout='0'" class="btn btn-danger">Sign Out</a>
        <?php } } else { ?>
            <a href="register.php" class="btn me-3" style="background-color: #404040; color: #fff4f4;">Register</a>
            <a href="signin.php" class="btn" style="background-color: #d9c3a9;">Sign In</a>
        <?php } ?>
      </form>
    </div>
  </div>
</nav>