<div class="row">
    <div class="col-md-5">
        <p>List the order</p>
    </div>
    <div class="col-md-7">
        <form action="" method="GET" id="orderForm">
            <input type="hidden" name="action" value="manageorders">
            <input type="hidden" name="query" value="list">
            <div class="row">
                <div class="col-md-4">
                    <input type="date" name="date" value="<?= isset($_GET['date']) == true ? $_GET['date'] : '' ?>" class="form-control">
                </div>

                <div class="col-md-4">
                    <input placeholder="address..." type="text" name="address" value="<?= isset($_GET['address']) == true ? $_GET['address'] : '' ?>" class="form-control">
                </div>

                <div class="col-md-4" style="width: 20%;">
                    <select name="status" class="form-select">
                        <option value="0" <?= isset($_GET['status']) == true ? ($_GET['status'] == '0' ? 'selected' : '') : '' ?>>Approve</option>
                        <option value="1" <?= isset($_GET['status']) == true ? ($_GET['status'] == '1' ? 'selected' : '') : '' ?>>Pending</option>
                    </select>
                </div>

                <div class="col-md-4" style="padding: 0; margin:20px 0px 20px 0px; float:right;">
                    <button name="submit" type="submit" class="btn btn-primary">Filter</button>
                    <a href="#" id="resetButton" class="btn btn-danger">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>


<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">ID of order</th>
            <th scope="row">ID of user</th>
            <th scope="row">Customer name</th>
            <th scope="row">Address</th>
            <th scope="row">Phone number</th>
            <th scope="row">Status</th>
            <th scope="row">Date order</th>
            <th scope="row">Manage</th>
        </tr>

        <?php
        $sql_lietke_dh = "SELECT * FROM orders,tbl_shipping WHERE orders.users_id = tbl_shipping.customer_id ";
        if ((isset($_GET['date']) && $_GET['date'] != '')) {
            $date = $_GET['date'];
            $sql_lietke_dh .= " AND orders.order_date LIKE '%" . $date . "%'";
        }
        if (isset($_GET['status']) && $_GET['status'] != '') {
            $status = $_GET['status'];
            $sql_lietke_dh .= "AND orders.status_order = " . $status;
        }
        if (isset($_GET['address']) && $_GET['address'] != '') {
            $address = $_GET['address'];
            $sql_lietke_dh .= " AND tbl_shipping.address LIKE '%" . $address . "%'";
        }

        $sql_lietke_dh .= " ORDER BY orders.orders_id DESC";

        $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_dh)) {
            $i++;
        ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['code_orders'] ?></td>
                <td><?php echo $row['users_id'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td>
                    <a href="modules/manageorder/xuly.php?cart_status=0&coder=<?php echo $row['code_orders'] ?>" <?php if ($row['status_order'] == 1) {  ?> style="color: rgb(254,192,94);" <?php } ?>>
                        <?php
                        if ($row['status_order'] == 1) {
                            echo 'Pending';
                        } else {
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("orderForm");

        document.getElementById("resetButton").addEventListener("click", function(event) {
            event.preventDefault();

            const dateInput = form.querySelector('input[type="date"]');
            dateInput.value = '';

            const statusSelect = form.querySelector('select[name="status"]');
            statusSelect.value = '0';

            const addressInput = form.querySelector('input[type="text"]');
            addressInput.value = '';

            form.submit();
        });
    });
</script>