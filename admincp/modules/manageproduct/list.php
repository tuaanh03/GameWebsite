<style>
    .inner-table th,
    .inner-table td {
        padding: 30px;
        /* Điều chỉnh giá trị padding tùy thích */
    }
</style>

<?php
$sql_lietke_sp = "SELECT * FROM product,category,genres WHERE product.category_id = category.category_id AND product.genre_id = genres.genre_id ORDER BY product_id DESC";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
// liet ke the loai
?>

<p>Manage products</p>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">Product Name</th>
            <th scope="row">Product ID</th>
            <th scope="row">Price</th>
            <th scope="row">Quantity</th>
            <th scope="row">Status</th>
            <th scope="row">Thumnail</th>
            <th scope="row">Show details</th>
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
                <td><?php echo number_format($row['price']) . 'đ' ?></td>
                <td><?php echo $row['quantity'] ?></td>
                <td><?php if ($row['statuspr'] == 1) {
                        echo 'Activate';
                    } else {
                        echo 'Hide';
                    } ?></td>

                <td><img src="modules/manageproduct/uploads/<?php echo $row['thumbnail'] ?>" alt="" style="width: 150px; "></td>

                <td><button id="toggleButton<?php echo $i ?>" class="btn btn-primary" onclick="toggleText('<?php echo $i ?>')">Show more details</button>
                    <div id="hiddenText<?php echo $i ?>" style="display: none;">
                        <table class="inner-table">
                            <thead>
                                <tr>
                                    <th scope="row">Category</th>
                                    <th scope="row">Genre</th>
                                    <th scope="row">Console type</th>
                                    <th scope="row">Language</th>
                                    <th scope="row">Player(s)</th>
                                    <th scope="row">Publisher</th>
                                    <th scope="row">ESRB</th>

                                </tr>

                            </thead>
                            <tbody>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><?php echo $row['genre_name'] ?></td>
                                <td><?php echo $row['console_type'] ?></td>
                                <td><?php echo $row['languages'] ?></td>
                                <td><?php echo $row['player'] ?></td>
                                <td><?php echo $row['publisher_name'] ?></td>

                                <td><?php if ($row['esrb'] == 1) {
                                        echo 'EARLYCHILDHOOD';
                                    } elseif ($row['esrb'] == 2) {
                                        echo 'EVERYONE';
                                    } elseif ($row['esrb'] == 3) {
                                        echo 'EVERYONE 10+';
                                    } elseif ($row['esrb'] == 4) {
                                        echo 'TEEN';
                                    } elseif ($row['esrb'] == 5) {
                                        echo 'MATURE 17+';
                                    } else {
                                        echo 'ADULTS ONLY 18+';
                                    } ?>
                                </td>
                            </tbody>
                        </table>

                    </div>
                </td>

                <td>
                    <a href="javascript:;" onclick="confirmDelete(<?php echo $row['product_id'] ?>)">Delete</a> | <a href="?action=manageproducts&query=modified&idsanpham=<?php echo $row['product_id'] ?>">Modified</a>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>

<script>
    function confirmDelete(productId) {
        var result = confirm("Are you sure you want to delete this product?");
        if (result) {
            window.location = "modules/manageproduct/xuly.php?idsanpham=" + productId;
        }
    }
</script>


<script>
    function toggleText(index) {
        const toggleButton = document.getElementById('toggleButton' + index);
        const hiddenText = document.getElementById('hiddenText' + index);

        // Kiểm tra trạng thái hiện tại của dòng chữ
        if (hiddenText.style.display === 'none') {
            // Nếu dòng chữ đang ẩn, hiển thị nó
            hiddenText.style.display = 'block';
            toggleButton.textContent = 'Hide'; // Thay đổi văn bản của nút
        } else {
            // Nếu dòng chữ đang hiển thị, ẩn nó
            hiddenText.style.display = 'none';
            toggleButton.textContent = 'Show more details'; // Thay đổi văn bản của nút
        }
    }
</script>