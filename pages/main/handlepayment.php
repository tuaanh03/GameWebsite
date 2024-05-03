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
$sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE customer_id = '$id_dangky' LIMIT 1");
$row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);

$id_shipping = $row_get_vanchuyen['id_shipping'];
$total_money = 0;
foreach ($_SESSION['cart'] as $key => $value) {
    $thanhtien = $value['quantity'] * $value['price'];
    $total_money += $thanhtien;
}

if ($cart_payment == 'cash' || $cart_payment == 'transfer') {
    //insert đơn hàng
    $insert_cart = "INSERT INTO orders(users_id,code_orders,order_date,status_order,cart_payment,cart_shipping) VALUE('" . $id_khachhang . "','" . $code_order . "','" . $now . "',1,'" . $cart_payment . "', '" . $id_shipping . "')";
    $cart_query = mysqli_query($mysqli, $insert_cart);
    if ($cart_query) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $id_sanpham = $value['id'];
            $soluong = $value['quantity'];
            $insert_order_details = "INSERT INTO order_details(product_id,code_orders,quantity_order) VALUE('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "')";
            mysqli_query($mysqli, $insert_order_details);
        }
    }
    header("Location:../../index.php?manage=thankyou");
} elseif ($cart_payment == 'vnpay') {
    
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
        $insert_cart = "INSERT INTO orders(users_id,code_orders,order_date,status_order,cart_payment,cart_shipping) VALUE('" . $id_khachhang . "','" . $code_order . "','" . $now . "',1,'" . $cart_payment . "', '" . $id_shipping . "')";
        $cart_query = mysqli_query($mysqli, $insert_cart);
        if ($cart_query) {
            foreach ($_SESSION['cart'] as $key => $value) {
                $id_sanpham = $value['id'];
                $soluong = $value['quantity'];
                $insert_order_details = "INSERT INTO order_details(product_id,code_orders,quantity_order) VALUE('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "')";
                mysqli_query($mysqli, $insert_order_details);
            }
        }
        header('Location: ' . $vnp_Url);
        unset($_SESSION['cart']);
        die();
    } else {
        echo json_encode($returnData);
    }
    // vui lòng tham khảo thêm tại code demo
} elseif ($cart_payment == 'momo') {
    echo 'Thanh toan bằng momo';
}

if($cart_query)
{
    unset($_SESSION['cart']);
}



