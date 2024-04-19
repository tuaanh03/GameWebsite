<?php
$sql_pro = "SELECT * FROM product WHERE product.category_id = '$_GET[id]' ORDER BY product.product_id DESC";
$query_pro = mysqli_query($mysqli, $sql_pro);
// danhmuc
$sql_cate = "SELECT * FROM category WHERE category_id = '$_GET[id]' LIMIT 1";
$query_cate = mysqli_query($mysqli, $sql_cate);
$row_title = mysqli_fetch_array($query_cate);
?>

<h3 style="color: black; font-size:50px"><?php echo $row_title['category_name'] ?></h3>

<div class="filter-bar">
    <div class="filter">
        <span>
            <label>Sort by:</label>
            <select name="#">
                <option value="#" selected>Default</option>
                <option value="#">Name (A-Z)</option>
                <option value="#">Name (Z-A)</option>
                <option value="#">Price (Low > High)</option>
                <option value="#">Price (High > Low)</option>
            </select>
        </span>
        <span>
            <label>Genre</label>
            <select name="#">
                <option value="#">Show All</option>
                <option value="#">Action</option>
                <option value="#">Racing</option>
                <option value="#">Strategy</option>
            </select>
        </span>
        <span>
            <label>Show:</label>
            <select name="#">
                <option value="#">8</option>
                <option value="#">16</option>
                <option value="#">24</option>
            </select>
        </span>
    </div> <!-- .filter -->

    <div class="pagination">
        <a href="#" class="page-number"><i class="fa fa-angle-left"></i></a>
        <span class="page-number current">1</span>
        <a href="#" class="page-number">2</a>

        <a href="#" class="page-number"><i class="fa fa-angle-right"></i></a>
    </div> <!-- .pagination -->
</div> <!-- .filter-bar -->

<div class="product-list">
    <?php
    while ($row_pro = mysqli_fetch_array($query_pro)) {
    ?>
        <div class="product">
            <a href="index.php?manage=singleproduct&id=<?php echo $row_pro['product_id'] ?>">
                <img src="admincp/modules/manageproduct/uploads/<?php echo $row_pro['thumbnail'] ?>" alt="" class="card-image">
                <div class="card-content">
                    <div class="card-top">
                        <h3 class="card-title"><?php echo $row_pro['name_product'] ?></h3>
                    </div>
                    <div class="card-bottom">
                        <span class="gia"><?php echo number_format($row_pro['price']) . '₫' ?></span>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
</div> <!-- .product-list -->

<div class="pagination-bar">
    <div class="pagination ">
        <a href="#" class="page-number"><i class="fa fa-angle-left"></i></a>
        <span class="page-number current">1</span>
        <a href="#" class="page-number">2</a>

        <a href="#" class="page-number"><i class="fa fa-angle-right"></i></a>
    </div> <!-- .pagination -->
</div>