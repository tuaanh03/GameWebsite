<p>View detail orders</p>
<?php

// Fetch shipping address
$sql_shipping_address = "SELECT * FROM tbl_shipping WHERE code_orders = '$_GET[coder]'";
$query_shipping_address = mysqli_query($mysqli, $sql_shipping_address);
$row_shipping_address = mysqli_fetch_assoc($query_shipping_address);
$customer_name = $row_shipping_address['name'];
$shipping_province = $row_shipping_address['province'];
$shipping_district = $row_shipping_address['district'];
$shipping_ward = $row_shipping_address['ward'];
$shipping_address = $row_shipping_address['address'];

// Fetch order details

$sql_lietke_dh = "SELECT * FROM order_details,product WHERE order_details.product_id = product.product_id AND order_details.code_orders = '$_GET[coder]' ORDER BY order_details.id_order_details DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
$total_money = 0;
?>

<h3>Id order: <?php echo $_GET['coder'] ?> </h3>
<h3>Customer Name: <?php echo $customer_name ?> </h3>
<h3 style="margin-bottom: 30px;">Shipping Address:  <span><?php echo $shipping_address; ?>, <?php echo $shipping_ward; ?>, <?php echo $shipping_district; ?>, <?php echo $shipping_province; ?></span></h3>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>   
            <th scope="row">Thumbnail</th>    
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
                <td><img src="modules/manageproduct/uploads/<?php echo $row['thumbnail'] ?>" alt="" style="width: 100px; "></td>
                <td><?php echo $row['name_product'] ?></td>
                <td><?php echo $row['quantity_order'] ?></td>
                <td><?php echo number_format($row['price']) . 'đ'; $total_money += $thanhtien;  ?></td>                
            </tr>
        <?php
        } ?>

    </tbody>
</table>
<h3>Total money: <?php echo number_format($total_money) . 'đ'; ?>  </h3>
