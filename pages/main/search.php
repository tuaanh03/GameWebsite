<?php
if(isset($_POST['timkiem']))
{
    $tukhoa = $_POST['tukhoa'];
}
$sql_pro = "SELECT * FROM product,category WHERE product.category_id = category.category_id AND product.name_product LIKE '%".$tukhoa."%' ";
$query_pro = mysqli_query($mysqli, $sql_pro);
?>

<section>
    <header>
        <h2 class="section-title">Search: <?php echo $tukhoa  ?></h2>
       
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

    </div>

</section>
