<?php
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    unset($_SESSION['dangky']);
}
?>


<div class="site-header">
    <div class="container">
        <a href="index.php" id="branding">
            <img src="images/logo.png" alt="" class="logo">
            <div class="logo-text">
                <h1 class="site-title">Company name</h1>
                <small class="site-description">Tagline goes here</small>
            </div>
        </a> <!-- #branding -->

        <div class="right-section pull-right">
            <a href="index.php?manage=carts" class="cart"><i class="icon-cart"></i> 0 items in cart</a>
            <?php
            if (isset($_SESSION['dangky'])) {
            ?>
                <a href="#"><?php if (isset($_SESSION['dangky'])) echo $_SESSION['dangky'] ?></a>
                <a href="index.php?manage=historypurchase">History purchase</a>
                <a href="index.php?logout=1" class="login-button">Log out</a>
            <?php
            } else {
            ?>
                <span><a href="index.php?manage=register" class="login-button">Register</a>/<a href="index.php?manage=login" style="margin-left:0px;" class="login-button">Login</a></span>
            <?php } ?>
        </div> <!-- .right-section -->

        <div class="main-navigation">
            <button class="toggle-menu"><i class="fa fa-bars"></i></button>
            <?php
            include("menu.php");
            ?>


            <div class="search-form">
                <form action="index.php?manage=search" method="POST">
                    <input name="tukhoa" type="text" placeholder="Search...">
                    <button name="timkiem" type="submit" value=""><label><img src="images/icon-search.png"></label></button>
                </form>
            </div> <!-- .search-form -->

            <div class="mobile-navigation"></div> <!-- .mobile-navigation -->
        </div> <!-- .main-navigation -->
    </div> <!-- .container -->
</div> <!-- .site-header -->



<!-- POST : truyền dữ liệu ngầm
     GET : truyền dữ liệu in trên url luôn -->