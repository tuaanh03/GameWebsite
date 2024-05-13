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

<h1>Thank you !</h1>

<h2>Detail orders: <?php echo $_SESSION['save_code'] ?></h2>
<?php
$save_code = $_SESSION['save_code'];
// Fetch shipping address
$sql_shipping_address = "SELECT * FROM tbl_shipping WHERE code_orders = '".$save_code."'";
$query_shipping_address = mysqli_query($mysqli, $sql_shipping_address);
$row_shipping_address = mysqli_fetch_assoc($query_shipping_address);
$customer_name = $row_shipping_address['name'];
$shipping_province = $row_shipping_address['province'];
$shipping_district = $row_shipping_address['district'];
$shipping_ward = $row_shipping_address['ward'];
$shipping_address = $row_shipping_address['address'];
$shipping_phone = $row_shipping_address['phone'];

// Fetch order details

$sql_lietke_dh = "SELECT * FROM order_details,product WHERE order_details.product_id = product.product_id AND order_details.code_orders = '".$save_code."' ORDER BY order_details.id_order_details DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
$total_money = 0;
?>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="text-left logo p-2 px-5"> <img src="https://i.imgur.com/2zDU056.png" width="50"> </div> -->
                <div class="invoice p-5">
                    <h5>Your order No: <?php echo $save_code ?> </h5> <span class="font-weight-bold d-block mt-4">Customer Name: <?php echo $customer_name ?></span><span class="font-weight-bold d-block mt-4">Phone number: <?php echo $shipping_phone ?></span>
                    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>

                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Order No</span> <span><?php echo $save_code ?></span> </div>
                                    </td>

                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Shiping Address</span> <span style="font-weight: bold;"><?php echo $shipping_address; ?>, <?php echo $shipping_ward; ?>, <?php echo $shipping_district; ?>, <?php echo $shipping_province; ?></span> </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="product border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <?php
                                $i = 0;
                                while ($row = mysqli_fetch_array($query_lietke_dh)) {
                                    $i++;
                                    $thanhtien = $row['price'] * $row['quantity_order'];
                                ?>
                                    <tr>
                                        <td width="20%"> <img src="admincp/modules/manageproduct/uploads/<?php echo $row['thumbnail'] ?>" width="90"> </td>
                                        <td width="60%"> <span class="font-weight-bold"><?php echo $row['name_product'] ?></span>
                                            <div class="product-qty"> <span class="d-block">Quantity:<?php echo $row['quantity_order'] ?></span></div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right"> <span class="font-weight-bold"><?php echo number_format($row['price']) . 'đ';
                                                                                                    $total_money += $thanhtien;  ?></span> </div>
                                        </td>
                                    </tr>
                                <?php
                                } ?>


                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tbody class="totals">
                                    <!-- <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>$168.50</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>$22</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Tax Fee</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>$7.65</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span class="text-success">$168.50</span> </div>
                                        </td>
                                    </tr> -->
                                    <tr class="border-top border-bottom">
                                        <td>
                                            <div class="text-left"> <span class="font-weight-bold">Subtotal</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span class="font-weight-bold"><?php echo number_format($total_money) . 'đ'; ?></span> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <p class="font-weight-bold mb-0">Thanks for shopping with us!</p> <span>AloneWolf Team</span>
                </div>
                <!-- <div class="d-flex justify-content-between footer p-3"> <span>Need Help? visit our <a href="#"> help center</a></span> <span>12 June, 2020</span> </div> -->
            </div>
        </div>
    </div>
</div>

