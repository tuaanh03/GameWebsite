


<?php
$sql_pro = "SELECT * FROM product,category WHERE product.category_id = category.category_id AND product.statuspr = 1 ORDER BY product.product_id DESC LIMIT 25";
$query_pro = mysqli_query($mysqli, $sql_pro);
?>


<section>
    <header>
        <h2 class="section-title">New Products</h2>
        <!-- <a href="single.php" class="all">Show All</a> -->
    </header>

    <div class="product-list">
        <?php
        while ($row = mysqli_fetch_array($query_pro)) {
        ?>
            <div class="product">
                <a href="index.php?manage=singleproduct&id=<?php echo $row['product_id'] ?>">
                    <img src="admincp/modules/manageproduct/uploads/<?php echo $row['thumbnail'] ?>" alt="" class="card-image">
                    <div class="card-content">
                        <div class="card-top">
                            <h3 class="card-title"><?php echo $row['name_product'] ?></h3>
                        </div>
                        <div class="card-bottom">
                            <span class="gia"><?php echo number_format($row['price']) . '₫' ?></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

    </div> <!-- .product-list -->

</section>