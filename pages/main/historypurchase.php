<p>History</p>
<?php
// xử lý hủy đơn
if (isset($_GET['cart_status']) && isset($_GET['coder'])) {
    $status = $_GET['cart_status'];
   
    $code = $_GET['coder'];
    $sql = "UPDATE orders SET status_order='" . $status . "' WHERE code_orders='" . $code . "'";
    $query = mysqli_query($mysqli, $sql);
}

// xem chi tiết
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
            <th scope="row">Total money</th>
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
                <td><?php echo $row['code_orders']?></td>
                <td><?php echo number_format($row['total_money']) . 'đ' ?></td>
                <td>
                    <h4 <?php if ($row['status_order'] == 1) {  ?> style="color: rgb(254,192,94);" <?php } elseif ($row['status_order'] == 2) { ?>style="color: rgb(114,185,104);" <?php } elseif($row['status_order'] == -1){ ?> style="color: rgb(220,53,69);" <?php } elseif($row['status_order'] == 0){ ?> style="color: rgb(42,152,214);" <?php } ?>>
                        <?php
                        if ($row['status_order'] == 1) {
                            echo 'Pending';
                        } elseif ($row['status_order'] == 0) {
                            echo 'Approve';
                        } elseif ($row['status_order'] == 2) {
                            echo 'Completed';
                        }
                        elseif($row['status_order'] == -1)
                        {
                            echo 'Cancelled';
                        }
                        ?>
                    </h4>



                </td>

                <td>
                <?php echo $row['cart_payment'] ?>
                </td>
                <td>
                    <a href="index.php?manage=viewbill&coder=<?php echo $row['code_orders'] ?>" class="btn btn-primary" style="font-size: 10px;">View order details</a>
                    <?php if ($row['status_order'] != 2 && $row['status_order'] != -1  ) { ?>
                        | <a href="index.php?manage=profile&control=viewhistoryorder&coder=<?php echo $row['code_orders'] ?>&cart_status=-1" class="btn btn-danger" style="font-size: 10px;">Cancel</a>
                    <?php } ?>

                </td>

            </tr>
        <?php
        } ?>

    </tbody>
</table>

