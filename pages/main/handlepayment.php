<?php

use Carbon\Carbon;


session_start();
include("../../admincp/config/config.php");
require('../../carbon/autoload.php');
require_once('config_vnpay.php');

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

if ($cart_payment == 'cash' || $cart_payment == 'transfer') {
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
} elseif ($cart_payment == 'vnpay') {
    $_SESSION['save_code'] = $code_order;
    //thanh toán bằng vnpay
    $vnp_TxnRef = $code_order; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = 'Thanh toán đơn hàng đặt tại web';
    $vnp_OrderType = 'billpayment';


    $vnp_Amount = $total_money;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $vnp_ExpireDate = $expire;



    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount * 100,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate" => $vnp_ExpireDate

    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    // }

    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array(
        'code' => '00', 'message' => 'success', 'data' => $vnp_Url
    );
    if (isset($_POST['redirect'])) {
        $_SESSION['code_orders'] = $code_order;
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
        $update_total_price = "UPDATE orders SET total_money = '" . $total_money . "' WHERE code_orders = '" . $code_order . "' ";
        mysqli_query($mysqli, $update_total_price);
        header('Location: ' . $vnp_Url);
        unset($_SESSION['cart']);
        die();
    } else {
        echo json_encode($returnData);
    }
    // vui lòng tham khảo thêm tại code demo
} 

if ($cart_query) {
    unset($_SESSION['cart']);
}
