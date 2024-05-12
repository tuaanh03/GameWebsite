<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

    body {
        /* background-color: #ffe8d2; */
        font-family: 'Montserrat', sans-serif
    }

    .card {
        border: none
    }

    /* .logo {
        background-color: #eeeeeea8
    } */

    .totals tr td {
        font-size: 13px
    }

    .footer {
        background-color: #eeeeeea8
    }

    .footer span {
        font-size: 12px
    }

    .product-qty span {
        font-size: 12px;
        color: #dedbdb
    }
</style>


<h1>Detail orders: </h1>
<hr>
<?php

// Fetch shipping address
$sql_shipping_address = "SELECT * FROM tbl_shipping WHERE code_orders = '$_GET[coder]'";
$query_shipping_address = mysqli_query($mysqli, $sql_shipping_address);
$row_shipping_address = mysqli_fetch_assoc($query_shipping_address);
$customer_name = $row_shipping_address['name'];
$customer_phone = $row_shipping_address['phone'];
$shipping_province = $row_shipping_address['province'];
$shipping_district = $row_shipping_address['district'];
$shipping_ward = $row_shipping_address['ward'];
$shipping_address = $row_shipping_address['address'];

// Fetch order details

$sql_lietke_dh = "SELECT * FROM order_details,product WHERE order_details.product_id = product.product_id AND order_details.code_orders = '$_GET[coder]' ORDER BY order_details.id_order_details DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
$total_money = 0;
?>


<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="text-left logo p-2 px-5"> <img src="https://i.imgur.com/2zDU056.png" width="50"> </div> -->
                <div class="invoice p-5">
                    <h5>Your order No: <?php echo $_GET['coder'] ?> </h5> <span class="font-weight-bold d-block mt-4">Customer Name: <?php echo $customer_name ?></span><span class="font-weight-bold d-block mt-4">Phone number: <?php echo $customer_phone ?></span>
                    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>

                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Order No</span> <span><?php echo $_GET['coder'] ?></span> </div>
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