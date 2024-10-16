<!-- primary nav bar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <img src="" alt="logo">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="display_all.php">Products</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                    <i class="fa fa-shopping-cart"></i>
                    <sup><?php getCartItemCount(); ?></sup>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Total: LKR <?php getCartTotalPrice(); ?></a>
                </li>
            </ul>
            <form class="d-flex" action="search_product.php" method="GET">
                <input class="form-control me-2" type="search" name="search_data" placeholder="Search" aria-label="Search">
                <input class="btn btn-primary me-2" type="submit" name="search_data_products" value="Search">
            </form>
        </div>
    </div>
</nav>

<!-- secondary nav bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <?php
                if(isset($_SESSION['username'])) {
                    echo "<a class='nav-link' href='./users_area/profile.php'>Welcome " . $_SESSION['username'] . "</a>";
                } else {
                    echo "<a class='nav-link' href='#'>Welcome Guest</a>";
                }
            ?>
        </li>
        <li class="nav-item">
            <?php
                if(isset($_SESSION['username'])) {
                    echo "<a class='nav-link' href='./users_area/logout.php'>Logout</a>";
                } else {
                    echo "<a class='nav-link' href='./users_area/user_login.php'>Login</a>";
                }
            ?>
        </li>
    </ul>
</nav>