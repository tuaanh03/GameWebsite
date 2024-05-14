<?php

use Carbon\Carbon;


session_start();
include("../../admincp/config/config.php");
require('../../carbon/autoload.php');
$now = Carbon::now('Asia/Ho_Chi_Minh');

$id_khachhang = $_SESSION['id_khachhang'];
$code_order = rand(0, 9999);
$cart_payment = $_POST['payment'];
// lấy thông tin vận chuyển
$id_dangky = $_SESSION['id_khachhang'];
// $sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE customer_id = '$id_dangky' LIMIT 1");
// $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);

// $id_shipping = $row_get_vanchuyen['id_shipping'];
$total_money = 0;
foreach ($_SESSION['cart'] as $key => $value) {
    $thanhtien = $value['quantity'] * $value['price'];
    $total_money += $thanhtien;
}

//mới thêm 2:42
$sql_get_thongtin = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE customer_id = '$id_dangky' ORDER BY id_shipping DESC LIMIT 1");
$row_get_thongtin = mysqli_fetch_array($sql_get_thongtin);
$id_thongtin = $row_get_thongtin['id_shipping'];

$tongsoluong = 0;

if ($cart_payment == 'cash' || $cart_payment == 'transfer' || $cart_payment == 'momo') {
    //insert đơn hàng
    $_SESSION['save_code'] = $code_order;
    $insert_cart = "INSERT INTO orders(users_id,code_orders,order_date,status_order,cart_payment,cart_shipping) VALUE('" . $id_khachhang . "','" . $code_order . "','" . $now . "',1,'" . $cart_payment . "', '" . $id_thongtin . "')";
    $cart_query = mysqli_query($mysqli, $insert_cart);
    if ($cart_query) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $id_sanpham = $value['id'];
            $soluong = $value['quantity'];

            // thay đổi số lượng của sản phẩm khi khách hàng đã mua

            $take_quantity = "SELECT * FROM product WHERE product_id = '" . $id_sanpham . "'";
            $row_take_quantity = mysqli_fetch_assoc(mysqli_query($mysqli, $take_quantity));
            $tongsoluong = $row_take_quantity['quantity'] - $soluong;
            $update_quantity = "UPDATE product SET quantity = '" . $tongsoluong . "' WHERE product_id = '" . $id_sanpham . "'";
            mysqli_query($mysqli, $update_quantity);
            // thay đổi số lượng của sản phẩm khi khách hàng đã mua

            $insert_order_details = "INSERT INTO order_details(product_id,code_orders,quantity_order) VALUE('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "')";
            mysqli_query($mysqli, $insert_order_details);
            $insert_shipping = "UPDATE tbl_shipping SET code_orders = '" . $code_order . "' WHERE id_shipping = '" . $id_thongtin . "'";
            mysqli_query($mysqli, $insert_shipping);
        }
    }
    $update_basic_total_price = "UPDATE orders SET total_money = '" . $total_money . "' WHERE code_orders = '" . $code_order . "' ";
    mysqli_query($mysqli, $update_basic_total_price);
    header("Location:../../index.php?manage=thankyou");
} 
if ($cart_query) {
    unset($_SESSION['cart']);
}
