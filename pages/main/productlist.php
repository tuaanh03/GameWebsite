<?php



if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if ($page == '' || $page == 1) {
    $begin = 0;
} 
else {
    $begin = ($page - 1) * 8;  // 8 là số sản phẩm trong 1 trang
}


$sql_pro = "SELECT * FROM product WHERE product.category_id = '$_GET[id]' ORDER BY product.product_id DESC LIMIT $begin,8";
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

    <?php
    $category_id = $row_title['category_id'];
    $sql_trang = "SELECT * FROM product WHERE product.category_id = $category_id ";
    $query_trang = mysqli_query($mysqli, $sql_trang);
    $row_count = mysqli_num_rows($query_trang);
    $trang = ceil($row_count / 8);
    ?>

<div class="pagination">
    
    <?php
    if ($page == 1) {
        echo '';
    } else {
    ?>
        <a style="margin-right: 10px;" href="index.php?manage=product&page=<?php echo 1 ?>&id=<?php echo $row_title['category_id'] ?>" class="page-number"><i class="fa fa-angle-double-left"></i></a>
        <a href="index.php?manage=product&page=<?php echo $page - 1 ?>&id=<?php echo $row_title['category_id'] ?>" class="page-number"><i class="fa fa-angle-left"></i></a>
    <?php } ?>

    <?php

    for ($i = 1; $i <= $trang; $i++) {
        $isActive = ($i == $page) ? 'background-color: rgb(80,188,133);' : '';
    ?>
        <a href="index.php?manage=product&page=<?php echo $i ?>&id=<?php echo $row_title['category_id'] ?>" class="page-number" style="color:black; margin-left: 10px;  <?php echo $isActive; ?>"><?php echo $i ?></a>
    <?php } ?>
    <?php
    if ($page == $trang) {
        echo '';
    } else {
    ?>
        <a href="index.php?manage=product&page=<?php echo $page + 1 ?>&id=<?php echo $row_title['category_id'] ?>" class="page-number" style="margin-left: 10px;"><i class="fa fa-angle-right"></i></a>
        <a style="margin-left: 10px;" href="index.php?manage=product&page=<?php echo $trang ?>&id=<?php echo $row_title['category_id'] ?>" class="page-number" ><i class="fa fa-angle-double-right"></i></a>
    <?php } ?>
    
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
    <div class="pagination">
    
        <?php
        if ($page == 1) {
            echo '';
        } else {
        ?>
            <a style="margin-right: 10px;" href="index.php?manage=product&page=<?php echo 1 ?>&id=<?php echo $row_title['category_id'] ?>" class="page-number"><i class="fa fa-angle-double-left"></i></a>
            <a href="index.php?manage=product&page=<?php echo $page - 1 ?>&id=<?php echo $row_title['category_id'] ?>" class="page-number"><i class="fa fa-angle-left"></i></a>
        <?php } ?>

        <?php

        for ($i = 1; $i <= $trang; $i++) {
            $isActive = ($i == $page) ? 'background-color: rgb(80,188,133);' : '';
        ?>
            <a href="index.php?manage=product&page=<?php echo $i ?>&id=<?php echo $row_title['category_id'] ?>" class="page-number" style="color:black; margin-left: 10px;  <?php echo $isActive; ?>"><?php echo $i ?></a>
        <?php } ?>
        <?php
        if ($page == $trang) {
            echo '';
        } else {
        ?>
            <a href="index.php?manage=product&page=<?php echo $page + 1 ?>&id=<?php echo $row_title['category_id'] ?>" class="page-number" style="margin-left: 10px;"><i class="fa fa-angle-right"></i></a>
            <a style="margin-left: 10px;" href="index.php?manage=product&page=<?php echo $trang ?>&id=<?php echo $row_title['category_id'] ?>" class="page-number" ><i class="fa fa-angle-double-right"></i></a>
        <?php } ?>
        
    </div> <!-- .pagination -->
    <p style=" color:black;">Current page: <?php echo $page ?>/<?php echo $trang ?></p>
</div>