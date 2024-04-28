<?php
$sql_lietke_dh = "SELECT * FROM orders,tbl_customer WHERE orders.users_id = tbl_customer.customer_id ORDER BY orders.orders_id DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>

<p>List the order</p>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">ID of order</th>
            <th scope="row">Customer name</th>
            <th scope="row">Email</th>
            <th scope="row">Address</th>
            <th scope="row">Phone number</th>
            <th scope="row">Status</th>
            <th scope="row">Date order</th>
            <th scope="row">Manage</th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_dh)) {
            $i++;
        ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['code_orders'] ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['customer_address'] ?></td>
                <td><?php echo $row['phonenumber'] ?></td>
                <td >
                <a href="modules/manageorder/xuly.php?cart_status=0&coder=<?php echo $row['code_orders'] ?>" <?php if ($row['status_order'] == 1) {  ?> style="color: rgb(254,192,94);" <?php } ?>>
                <?php 
                    if ($row['status_order'] == 1) {
                        echo 'Pending';
                    }

                    else
                    {
                        echo 'Approve';
                    }
                    ?>
                </a>
                    
                </td>
                <td><?php echo $row['order_date'] ?></td>
                <td>
                    <a href="index.php?action=manageorders&query=vieworder&coder=<?php echo $row['code_orders'] ?>">View order details</a>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>