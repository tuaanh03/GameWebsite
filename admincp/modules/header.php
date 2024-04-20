<?php
    if(isset($_GET['logout']) && $_GET['logout'] == 1)
    {
        unset($_SESSION['dangnhap']);
        header('Location:login.php');
    }
?>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="adjust-nav">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="assets/img/logo.png" />
            </a>

        </div>

        <span class="logout-spn">
            <a href="index.php?logout=1" style="color:#fff;">LOGOUT</a>
        </span>
    </div>
</div>
<!-- /. NAV TOP  -->