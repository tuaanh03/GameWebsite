<?php


if (isset($_GET['vnp_Amount'])) {
    $vnp_Amount = $_GET['vnp_Amount'];
    $vnp_BankCode = $_GET['vnp_BankCode'];
    $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
    $vnp_PayDate = $_GET['vnp_PayDate'];
    $vnp_TmnCode = $_GET['vnp_TmnCode'];
    $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    $vnp_CardType = $_GET['vnp_CardType'];
    $code_orders = $_SESSION['code_orders'];

    $insert_vnpay = "INSERT INTO tbl_vnpay(vnp_amount,vnp_bankcode,vnp_banktranno,vnp_cardtype,vnp_orderinfo,vnp_paydate,vnp_tmncode,vnp_transactionno,code_orders) VALUE('" . $vnp_Amount . "',
        '" . $vnp_BankCode . "','" . $vnp_BankTranNo . "','" . $vnp_CardType . "','" . $vnp_OrderInfo . "','" . $vnp_PayDate . "','" . $vnp_TmnCode . "','" . $vnp_TransactionNo . "','" . $code_orders . "')";
    $cart_query = mysqli_query($mysqli, $insert_vnpay);
    if ($cart_query) {
        echo '<h3>Transfer by VNPAY successfully !</h3>';
    }
    else
    {
        echo 'Mission fail !';
    }
}

?>

<p>Thank you</p>

<h1>Detail orders: <?php echo $_SESSION['save_code'] ?></h1>
<?php
$save_code = $_SESSION['save_code'];
// Fetch shipping address
$sql_shipping_address = "SELECT * FROM tbl_shipping WHERE code_orders = '".$save_code."'";
$query_shipping_address = mysqli_query($mysqli, $sql_shipping_address);
$row_shipping_address = mysqli_fetch_assoc($query_shipping_address);
$shipping_province = $row_shipping_address['province'];
$shipping_district = $row_shipping_address['district'];
$shipping_ward = $row_shipping_address['ward'];
$shipping_address = $row_shipping_address['address'];

// Fetch order details

$sql_lietke_dh = "SELECT * FROM order_details,product WHERE order_details.product_id = product.product_id AND order_details.code_orders = '".$save_code."' ORDER BY order_details.id_order_details DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
$total_money = 0;
?>
<h2>Information of order</h2>
<h3>Id order: <?php echo $save_code ?> </h3>
<h3>Shipping Address:  <span style="font-weight: bold;"><?php echo $shipping_address; ?>, <?php echo $shipping_ward; ?>, <?php echo $shipping_district; ?>, <?php echo $shipping_province; ?></span></h3>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>       
            <th scope="row">Product name</th>
            <th scope="row">Quantity</th>
            <th scope="row">Price</th>
            
            
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_dh)) {
            $i++;
            $thanhtien = $row['price'] * $row['quantity_order'];
        ?>

            <tr>
                <td><?php echo $i ?></td>
                
                <td><?php echo $row['name_product'] ?></td>
                <td><?php echo $row['quantity_order'] ?></td>
                <td><?php echo number_format($row['price']) . 'đ'; $total_money += $thanhtien;  ?></td>                
            </tr>
        <?php
        } ?>

    </tbody>
</table>
<h3>Total money: <?php echo number_format($total_money) . 'đ'; ?>  </h3>

