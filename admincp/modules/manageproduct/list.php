<?php
$sql_lietke_sp = "SELECT * FROM product,category WHERE product.category_id = category.category_id ORDER BY product_id DESC";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
?>

<p>List the product</p>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">Product Name</th>
            <th scope="row">Product ID</th>
            <th scope="row">Price</th>
            <th scope="row">Quantity</th>
            <th scope="row">Category</th>
            <th scope="row">Thumnail</th>
            <th scope="row">Console type</th>
            <th scope="row">Language</th>
            <th scope="row">Player(s)</th>
            <th scope="row">Publisher</th>
            <th scope="row">Status</th>
            <th scope="row">ESRB</th>
            <th scope="row">Manage</th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_sp)) {
            $i++;
        ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['name_product'] ?></td>
                <td><?php echo $row['idproduct'] ?></td>
                <td><?php echo $row['price'] ?></td>
                <td><?php echo $row['quantity'] ?></td>
                <td><?php echo $row['category_name'] ?></td>
                <td><img src="modules/manageproduct/uploads/<?php echo $row['thumbnail'] ?>" alt="" style="width: 150px; "></td>
                <td><?php echo $row['console_type'] ?></td>
                <td><?php echo $row['languages'] ?></td>
                <td><?php echo $row['player'] ?></td>
                <td><?php echo $row['publisher_name'] ?></td>
                <td><?php if($row['statuspr'] == 1)
                {
                    echo 'Activate';
                }
                else
                {
                    echo 'Hide';
                } ?></td>
                <td><?php if($row['esrb'] == 1)
                {
                    echo 'EARLYCHILDHOOD';
                }
                elseif($row['esrb'] == 2)
                {
                    echo 'EVERYONE';
                }  
                elseif($row['esrb'] == 3)
                {
                    echo 'EVERYONE 10+';
                }
                elseif($row['esrb'] == 4)
                {
                    echo 'TEEN';
                }
                elseif($row['esrb'] == 5)
                {
                    echo 'MATURE 17+';
                }
                else
                {
                    echo 'ADULTS ONLY 18+';
                } ?></td>  

                <td>
                    <a href="modules/manageproduct/xuly.php?idsanpham=<?php echo $row['product_id'] ?>">Delete</a> | <a href="?action=manageproducts&query=modified&idsanpham=<?php echo $row['product_id'] ?>">Modified</a>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>