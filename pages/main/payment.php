<?php 
    session_start();
    include("../../admincp/config/config.php");
    $id_khachhang = $_SESSION['id_khachhang'];
    $code_order = rand(0,9999);
    $insert_cart = "INSERT INTO orders(users_id,code_orders,status_order) VALUE('".$id_khachhang."','".$code_order."',1)";
    $cart_query = mysqli_query($mysqli,$insert_cart);
    if($cart_query)
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            $id_sanpham = $value['id'];
            $soluong = $value['quantity'];
            $insert_order_details = "INSERT INTO order_details(product_id,code_orders,quantity) VALUE('".$id_sanpham."','".$code_order."','".$soluong."')";
            mysqli_query($mysqli,$insert_order_details);
        }
    }
    unset($_SESSION['cart']);
    header("Location:../../index.php?manage=thankyou");
?>