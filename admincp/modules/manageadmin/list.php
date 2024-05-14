<p>Manage admin</p>
<?php
$sql_lietke_user = "SELECT * FROM tbl_admin ORDER BY id_admin DESC";
$query_lietke_user = mysqli_query($mysqli, $sql_lietke_user);
?>


<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">Admin name</th>
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
                <td>
                    <a href="" <?php if ($row['admin_status'] == 1) {  ?> style="color: rgb(254,192,94);" <?php } ?>>
                        <?php
                        if ($row['admin_status'] == 1) {
                            echo '<i class="fa fa-lock" aria-hidden="true"></i>';
                        } else {
                            echo '<i class="fa fa-unlock" aria-hidden="true"></i>';
                        }
                        ?>
                    </a>

                </td>
                <td>
                    <?php 
                    if($row['username'] == $_SESSION['dangnhap']){
                        echo 'Current login';
                    }
                    else
                    {
                        ?>
                        <a href="modules/manageadmin/xuly.php?user_status=0&id=<?php echo $row['id_admin'] ?>">Enable</a> | <a href="modules/manageuser/xuly.php?user_status=1&id=<?php echo $row['id_admin'] ?>">Block</a>
                        <?php 
                    }
                    ?>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>