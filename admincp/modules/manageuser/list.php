<p>Manage customers</p>
<?php
$sql_lietke_user = "SELECT * FROM tbl_customer ORDER BY customer_id DESC";
$query_lietke_user = mysqli_query($mysqli, $sql_lietke_user);
?>


<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">Customer name</th>
            <th scope="row">Email</th>
            <th scope="row">Province</th>
            <th scope="row">District</th>
            <th scope="row">Ward</th>
            <th scope="row">Address</th>
            <th scope="row">Phone number</th>
            <th scope="row">Status</th>
            <th scope="row">Manage</th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_user)) {
            $i++;
        ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['customer_province'] ?></td>
                <td><?php echo $row['customer_district'] ?></td>
                <td><?php echo $row['customer_ward'] ?></td>
                <td><?php echo $row['customer_address'] ?></td>
                <td><?php echo $row['phonenumber'] ?></td>
                <td>

                    <a href="" <?php if ($row['status_user'] == 1) {  ?> style="color: rgb(254,192,94);" <?php } ?>>
                        <?php
                        if ($row['status_user'] == 1) {
                            echo '<i class="fa fa-lock" aria-hidden="true"></i>';
                        } else {
                            echo '<i class="fa fa-unlock" aria-hidden="true"></i>';
                        }
                        ?>
                    </a>

                </td>
                <td>
                    <a href="?action=manageusers&query=modified&iduser=<?php echo $row['customer_id'] ?>">Modified</a> | <a href="modules/manageuser/xuly.php?user_status=0&id=<?php echo $row['customer_id'] ?>">Enable</a> | <a href="modules/manageuser/xuly.php?user_status=1&id=<?php echo $row['customer_id'] ?>">Block</a>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>