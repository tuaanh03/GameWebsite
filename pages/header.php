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
                <h1 class="site-title">AloneWolf</h1>
                <small class="site-description">Tagline goes here</small>
            </div>
        </a> <!-- #branding -->

        <div class="right-section pull-right">
            <a href="index.php?manage=carts" class="cart"><i class="icon-cart"></i> <?php if(isset($_SESSION['cart'])) {echo count($_SESSION['cart']);} else{echo '0';}?> item(s) in cart</a>
            <?php
            if (isset($_SESSION['dangky'])) {
            ?>
                <li class="menu-item drop-down" style="float: right; list-style-type: none;">

                    <a style="padding: 3px;" class="nav-link" href="" id="navbarDropdown" role="button" aria-expanded="false"><?php if (isset($_SESSION['dangky'])) echo $_SESSION['dangky'] ?></a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                        <a class="dropdown-item" href="index.php?manage=profile&control=viewprofile"><span style="color: black;">Information</span></a>
                            <a class="dropdown-item" href="index.php?manage=profile&control=viewhistoryorder"><span style="color: black;">History purchase</span></a>
                            <a class="dropdown-item" href="index.php?logout=1" class="login-button"><span style="color: black;">Log out</span></a>
                        </li>
                        <style>
                            .dropdown-item:hover {
                                font-weight: 600;
                                background: none;
                                font-size: 20px;
                            }
                        </style>
                    </ul>
                </li>


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
                <form action="index.php" method="GET">
                    <!-- Khi sử dụng method GET thì không thể nào truyền url với ?manage=search nên đây là cách để dùng  -->
                    <input type="hidden" name="manage" value="search"> 
                     <!--  -->
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