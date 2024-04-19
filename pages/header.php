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
            <a href="#" class="login-button">Login/Register</a>
        </div> <!-- .right-section -->

        <div class="main-navigation">
            <button class="toggle-menu"><i class="fa fa-bars"></i></button>
            <?php
                include("menu.php");            
            ?>
            <div class="search-form">
                <label><img src="images/icon-search.png"></label>
                <input type="text" placeholder="Search...">
            </div> <!-- .search-form -->

            <div class="mobile-navigation"></div> <!-- .mobile-navigation -->
        </div> <!-- .main-navigation -->
    </div> <!-- .container -->
</div> <!-- .site-header -->