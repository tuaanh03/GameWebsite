<p>History</p>
<?php
$id_khachhang = $_SESSION['id_khachhang'];
$sql_lietke_dh = "SELECT * FROM orders,tbl_customer WHERE orders.users_id = tbl_customer.customer_id AND orders.users_id = '$id_khachhang' ORDER BY orders.orders_id DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">Date order</th>
            <th scope="row">ID of order</th>     
            <th scope="row">Status</th>
            
            <th scope="row">Payment Method</th>
            <th scope="row">Manage</th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_dh)) {
            $i++;
        ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['order_date'] ?></td>
                <td><?php echo $row['code_orders'] ?></td>
                <td>
                    <h4 <?php if ($row['status_order'] == 1) {  ?> style="color: rgb(254,192,94);" <?php } else { ?> style="color: rgb(66,148,216)" <?php } ?>>
                        <?php
                        if ($row['status_order'] == 1) {
                            echo 'Pending';
                        } else {
                            echo 'Approve';
                        }
                        ?>
                    </h4>



                </td>
                
                <td>
                    <?php
                    if ($row['cart_payment'] == 'vnpay') {
                    ?>
                        <a href="index.php?manage=historypurchase&paymentgateway=<?php echo $row['cart_payment'] ?>&coder=<?php echo $row['code_orders'] ?>"><?php echo $row['cart_payment'] ?></a>
                    <?php } else { ?>
                        <?php echo $row['cart_payment'] ?>
                    <?php } ?>
                </td>
                <td>
                    <a href="index.php?manage=viewbill&coder=<?php echo $row['code_orders'] ?>">View order details</a>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>

<?php
if (isset($_GET['paymentgateway'])) {
    $paymentgateway = $_GET['paymentgateway'];
    $code_cart = $_GET['coder'];
    echo '<h4>Cổng thanh toán:  ' . $paymentgateway . ' </h4>';
    if ($paymentgateway == 'vnpay') {
        $sql_vnpay = mysqli_query($mysqli, "SELECT * FROM tbl_vnpay WHERE code_orders = '$code_cart' LIMIT 1 ");
        $row_vnpay = mysqli_fetch_array($sql_vnpay);
?>
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">vnp_amount</th>
                    <th scope="row">vnp_bankcode</th>
                    <th scope="row">vnp_banktranno</th>
                    <th scope="row">vnp_orderinfo</th>
                    <th scope="row">vnp_paydate</th>
                    <th scope="row">vnp_tmncode</th>
                    <th scope="row">vnp_transactionno</th>


                </tr>



                <tr>
                    <td><?php echo $row_vnpay['vnp_amount'] ?></td>
                    <td><?php echo $row_vnpay['vnp_bankcode'] ?></td>
                    <td><?php echo $row_vnpay['vnp_banktranno'] ?></td>
                    <td><?php echo $row_vnpay['vnp_orderinfo'] ?></td>
                    <td><?php echo $row_vnpay['vnp_paydate'] ?></td>
                    <td><?php echo $row_vnpay['vnp_tmncode'] ?></td>
                    <td><?php echo $row_vnpay['vnp_transactionno'] ?></td>
                </tr>


            </tbody>
        </table>
<?php
    }
}
?>