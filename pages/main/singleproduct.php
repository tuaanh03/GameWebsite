<?php
$sql_chitiet = "SELECT * FROM product,genres WHERE product.genre_id = genres.genre_id AND product_id='$_GET[id]' LIMIT 1";
$query_chitiet = mysqli_query($mysqli, $sql_chitiet);
while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
?>

    <div class="entry-content">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="product-images">
                    <figure class="large-image">
                        <a href="admincp/modules/manageproduct/uploads/<?php echo $row_chitiet['thumbnail'] ?>"><img src="admincp/modules/manageproduct/uploads/<?php echo $row_chitiet['thumbnail'] ?>" alt=""></a>
                    </figure>
                    <!-- <div class="thumbnails">
                        <a href="dummy/image-2.jpg"><img src="dummy/small-thumb-1.jpg" alt=""></a>
                        <a href="dummy/image-3.jpg"><img src="dummy/small-thumb-2.jpg" alt=""></a>
                        <a href="dummy/image-4.jpg"><img src="dummy/small-thumb-3.jpg" alt=""></a>
                    </div> -->
                </div>
            </div>
            <div class="col-sm-6 col-md-8">
                <form action="pages/main/addtocart.php?idsanpham=<?php echo $row_chitiet['product_id'] ?>" method="POST">
                    <h2 class="entry-title" style="color: black; font-size:40px"><?php echo $row_chitiet['name_product'] ?></h2>
                    <ul>
                        <li>Publisher: <?php echo $row_chitiet['publisher_name'] ?></li>
                        <li>Model: <?php echo $row_chitiet['idproduct'] ?></li>
                    </ul>
                    <small class="price" style="margin-top: 25px;"><?php echo number_format($row_chitiet['price']) . '₫' ?></small>
                    <a style="background-color: rgb(100,196,147);" href="#demo" class="btn btn-primary" data-toggle="collapse">Details</a>
                    <div id="demo" class="collapse" style="margin-top: 25px; color:black;">
                        <h2>Genre: <span><?php echo $row_chitiet['genre_name'] ?></span></h2>
                        <h2>Console type: <span><?php echo $row_chitiet['console_type'] ?></span></h2>
                        <h2>ESRB:
                            <span>
                                <?php if ($row_chitiet['esrb'] == 1) {
                                    echo 'EARLYCHILDHOOD';
                                } elseif ($row_chitiet['esrb'] == 2) {
                                    echo 'EVERYONE';
                                } elseif ($row_chitiet['esrb'] == 3) {
                                    echo 'EVERYONE 10+';
                                } elseif ($row_chitiet['esrb'] == 4) {
                                    echo 'TEEN';
                                } elseif ($row_chitiet['esrb'] == 5) {
                                    echo 'MATURE 17+';
                                } else {
                                    echo 'ADULTS ONLY 18+';
                                } ?>
                            </span>
                        </h2>
                        <h2>Language(s): <span><?php echo $row_chitiet['languages'] ?></span></h2>
                        <h2>Player: <span><?php echo $row_chitiet['player'] ?></span></h2>
                        <h2>Publisher: <span><?php echo $row_chitiet['publisher_name'] ?></span></h2>

                    </div>

                    <p style="margin-top: 25px;"><?php echo $row_chitiet['descriptions'] ?></p>


                    <div class="addtocart-bar">
                        <form action="#">
                            <input name="themgiohang" type="submit" value="Add to cart">
                        </form>

                        <!-- <div class="social-links square">
                            <strong>Share</strong>
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>
                        </div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section>
        <header>
            <h2 class="section-title">Similiar Product</h2>
        </header>
        <?php
        $sql_similar = "SELECT * FROM product WHERE genre_id = ? AND product_id != ? LIMIT 4";
        $query_similar = mysqli_query($mysqli, $sql_chitiet);

        ?>

        <div class="product-list">
            <?php 
            if ($stmt_similar = mysqli_prepare($mysqli, $sql_similar)) {
                mysqli_stmt_bind_param($stmt_similar, "ii", $row_chitiet['genre_id'], $_GET['id']);
                mysqli_stmt_execute($stmt_similar);
                $result_similar = mysqli_stmt_get_result($stmt_similar);
    
                while ($row_similar = mysqli_fetch_array($result_similar)) { ?>
                <div class="product">
                    <div class="inner-product">
                        <div class="figure-image">
                            <img src="admincp/modules/manageproduct/uploads/<?php echo $row_similar['thumbnail'] ?>" alt=" Game 1">
                        </div>
                        <h3 class="product-title"><a href="#"><?php echo $row_similar['name_product'] ?></a></h3>
                        <small class="price"><?php echo number_format($row_similar['price']) . '₫' ?></small>
                        <p><?php echo $row_similar['descriptions'] ?></p>
                        <a href="#" class="button">Add to cart</a>
                        <a href="#" class="button muted">Read Details</a>
                    </div>
                </div> <!-- .product -->

            <?php }
            } ?>

        </div> <!-- .product-list -->

    </section>

<?php } ?>