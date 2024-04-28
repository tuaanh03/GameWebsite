<p>View detail orders</p>
<?php
$sql_lietke_dh = "SELECT * FROM order_details,product WHERE order_details.product_id = product.product_id AND order_details.code_orders = '$_GET[coder]' ORDER BY order_details.id_order_details DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
$total_money = 0;
?>

<h3>Id order: <?php echo $_GET['coder'] ?> </h3>
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
