<?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if ($page == '' || $page == 1) {
    $begin = 0;
} else {
    $begin = ($page - 1) * 8;  // 8 là số sản phẩm trong 1 trang
}

if (isset($_GET['manage']) && $_GET['manage'] == 'search') {
    if (isset($_GET['timkiem'])) { 
        $tukhoa = $_GET['tukhoa'];
        $sql_pro = "SELECT * FROM product,category WHERE product.category_id = category.category_id AND product.name_product LIKE '%" . $tukhoa . "%' AND product.statuspr = 1 ORDER BY product.product_id DESC ";
        $sql_pro .= " LIMIT $begin, 8";
        $query_pro = mysqli_query($mysqli, $sql_pro);   
    } elseif (isset($_GET['timkiemnangcao'])) {
        $tukhoa = $_GET['tukhoa'];
        $danhmuc = $_GET['danhmuc']; // Lấy danh mục từ form nếu được chọn
        $theloai = $_GET['theloai']; // Lấy thể loại từ form nếu được chọn
        $sql_pro = "SELECT * FROM product, category,genres WHERE product.category_id = category.category_id AND product.genre_id = genres.genre_id AND product.statuspr = 1 ";

        // Thêm điều kiện tìm kiếm từ khóa nếu có
        if (!empty($tukhoa)) {
            $sql_pro .= " AND product.name_product LIKE '%" . $tukhoa . "%'  ";
        }

        // Thêm điều kiện danh mục nếu được chọn
        if (!empty($danhmuc) && $danhmuc != '0') {
            $sql_pro .= " AND product.category_id = " . $danhmuc;
        }

        // Thêm điều kiện thể loại nếu được chọn
        if (!empty($theloai) && $theloai != '0') {
            $sql_pro .= " AND product.genre_id = " . $theloai;
        }

        $sql_pro .= " ORDER BY product.product_id DESC LIMIT $begin, 8";

        $query_pro = mysqli_query($mysqli, $sql_pro);
    }
}

?>

<section>
    <!-- <header>
        <h2 class="section-title">Search: <?php echo $tukhoa  ?></h2>

    </header> -->

    <style>
        .form-inputs {
            position: relative;
        }

        .form-inputs .form-control {
            height: 45px;
            margin-bottom: 20px;
        }

        .form-inputs .form-control:focus {
            box-shadow: none;
            border: 1px solid #000;
        }

        .form-inputs i {
            position: absolute;
            right: 10px;
            top: 15px;
        }
    </style>


    <!-- Advanced Search -->
    <form action="index.php" method="GET">
        <div class="d-flex form-inputs">
            <!-- Khi sử dụng method GET thì không thể nào truyền url với ?manage=search nên đây là cách để dùng  -->
            <input type="hidden" name="manage" value="search">
            <input name="tukhoa" class="form-control" type="text" placeholder="Search any product...">
            <select name="danhmuc" style="height: 40px; margin-left:10px;">
                <option value="0" selected>All categories</option>
                <?php
                $sql_cate = "SELECT * FROM category ORDER BY category_id DESC";
                $query_cate = mysqli_query($mysqli, $sql_cate);
                while ($row_cate = mysqli_fetch_array($query_cate)) {
                ?>
                    <option value="<?php echo $row_cate['category_id'] ?>"><?php echo $row_cate['category_name'] ?></option>

                <?php } ?>

            </select>
            <select name="theloai" style="height: 40px; margin-left:10px;">
                <option value="0" selected>All genres</option>
                <?php
                $sql_genres = "SELECT * FROM genres ORDER BY genre_id DESC";
                $query_genres = mysqli_query($mysqli, $sql_genres);
                while ($row_cate = mysqli_fetch_array($query_genres)) {
                ?>
                    <option value="<?php echo $row_cate['genre_id'] ?>"><?php echo $row_cate['genre_name'] ?></option>

                <?php } ?>

            </select>
        </div>
        <button style="width: 100%; margin-bottom:20px;" name="timkiemnangcao" type="submit" value=""><label><img src="images/icon-search.png"></label></button>
    </form>

    <div class="product-list">
        <?php
        if (isset($query_pro) && mysqli_num_rows($query_pro) > 0) {
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
        <?php }
        } else {
            echo "<p style='color: red; font-weight: bold;margin-left:540px;'>No products found.</p>";
        }
        ?>

    </div>

    <?php
    if (isset($tukhoa) && isset($_GET['timkiemnangcao'])) {
        $danhmuc_phantrang = $_GET['danhmuc'];
        $theloai_phantrang = $_GET['theloai'];
        $sql_trang = "SELECT * FROM product WHERE name_product LIKE '%" . $tukhoa . "%' AND statuspr = 1";
        if (!empty($danhmuc_phantrang) && $danhmuc_phantrang != '0') {
            $sql_trang .= " AND product.category_id = " . $danhmuc_phantrang;
        }

        // Thêm điều kiện thể loại nếu được chọn
        if (!empty($theloai_phantrang) && $theloai_phantrang != '0') {
            $sql_trang .= " AND product.genre_id = " . $theloai_phantrang;
        }
        $query_trang = mysqli_query($mysqli, $sql_trang);
        $row_count = mysqli_num_rows($query_trang);
        $trang = ceil($row_count / 8);
    ?>


        <div class="pagination-bar">
            <div class="pagination ">
                <?php
                if ($page == 1) {
                    echo '';
                } else {
                ?>
                    <a style="margin-right: 10px;" href="index.php?manage=search&timkiemnangcao&page=<?php echo 1 ?>&tukhoa=<?php echo $tukhoa ?>&danhmuc=<?php echo $danhmuc ?>&theloai=<?php echo $theloai ?>" class="page-number"><i class="fa fa-angle-double-left"></i></a>
                    <a href="index.php?manage=search&timkiemnangcao&page=<?php echo $page - 1 ?>&tukhoa=<?php echo $tukhoa ?>&danhmuc=<?php echo $danhmuc ?>&theloai=<?php echo $theloai ?>" class="page-number"><i class="fa fa-angle-left"></i></a>
                <?php } ?>

                <?php

                for ($i = 1; $i <= $trang; $i++) {
                    $isActive = ($i == $page) ? 'background-color: rgb(80,188,133);' : '';
                ?>
                    <a href="index.php?manage=search&timkiemnangcao&page=<?php echo $i ?>&tukhoa=<?php echo $tukhoa ?>&danhmuc=<?php echo $danhmuc ?>&theloai=<?php echo $theloai ?>" class="page-number" style="color:black; margin-left: 10px;  <?php echo $isActive; ?>"><?php echo $i ?></a>
                <?php } ?>
                <?php
                if ($page == $trang) {
                    echo '';
                } else {
                    if ($trang != 0) {
                ?>
                        <a href="index.php?manage=search&timkiemnangcao&page=<?php echo $page + 1 ?>&tukhoa=<?php echo $tukhoa ?>&danhmuc=<?php echo $danhmuc ?>&theloai=<?php echo $theloai ?>" class="page-number" style="margin-left: 10px;"><i class="fa fa-angle-right"></i></a>
                        <a style="margin-left: 10px;" href="index.php?manage=search&timkiemnangcao&page=<?php echo $trang ?>&tukhoa=<?php echo $tukhoa ?>&danhmuc=<?php echo $danhmuc ?>&theloai=<?php echo $theloai ?>" class="page-number"><i class="fa fa-angle-double-right"></i></a>
                    <?php  } else {
                    ?>

                <?php
                    }
                } ?>
            </div> <!-- .pagination -->
        </div>
    <?php } elseif (isset($tukhoa) && isset($_GET['timkiem'])) {

        $sql_trang = "SELECT * FROM product WHERE name_product LIKE '%" . $tukhoa . "%' AND statuspr = 1";
        $query_trang = mysqli_query($mysqli, $sql_trang);
        $row_count = mysqli_num_rows($query_trang);
        $trang = ceil($row_count / 8);
    ?>


        <div class="pagination-bar">
            <div class="pagination ">
                <?php
                if ($page == 1) {
                    echo '';
                } else {
                ?>
                    <a style="margin-right: 10px;" href="index.php?manage=search&timkiem&page=<?php echo 1 ?>&tukhoa=<?php echo $tukhoa ?>" class="page-number"><i class="fa fa-angle-double-left"></i></a>
                    <a href="index.php?manage=search&timkiem&page=<?php echo $page - 1 ?>&tukhoa=<?php echo $tukhoa ?>" class="page-number"><i class="fa fa-angle-left"></i></a>
                <?php } ?>

                <?php

                for ($i = 1; $i <= $trang; $i++) {
                    $isActive = ($i == $page) ? 'background-color: rgb(80,188,133);' : '';
                ?>
                    <a href="index.php?manage=search&timkiem&page=<?php echo $i ?>&tukhoa=<?php echo $tukhoa ?>" class="page-number" style="color:black; margin-left: 10px;  <?php echo $isActive; ?>"><?php echo $i ?></a>
                <?php } ?>
                <?php
                if ($page == $trang) {
                    echo '';
                } else {
                    if ($trang != 0) {
                ?>
                        <a href="index.php?manage=search&timkiem&page=<?php echo $page + 1 ?>&tukhoa=<?php echo $tukhoa ?>" class="page-number" style="margin-left: 10px;"><i class="fa fa-angle-right"></i></a>
                        <a style="margin-left: 10px;" href="index.php?manage=search&timkiem&page=<?php echo $trang ?>&tukhoa=<?php echo $tukhoa ?>" class="page-number"><i class="fa fa-angle-double-right"></i></a>
                    <?php  } else {
                    ?>

                <?php
                    }
                } ?>
            </div> <!-- .pagination -->
        </div>
    <?php } ?>



</section>