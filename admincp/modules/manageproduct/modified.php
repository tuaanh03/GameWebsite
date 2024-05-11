<?php
$sql_sua_sp = "SELECT * FROM product WHERE product_id ='$_GET[idsanpham]' LIMIT 1";
$query_sua_sp = mysqli_query($mysqli, $sql_sua_sp);
?>
<p>Modified Product</p>
<table class="table">
    <form action="modules/manageproduct/xuly.php?idsanpham=<?php echo $_GET['idsanpham'] ?>" method="POST" enctype="multipart/form-data">
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($query_sua_sp)) {
            ?>
                <tr>
                    <th scope="row">Name of product</th>
                    <td><input type="text" value="<?php echo $row['name_product'] ?>" name="tensanpham"></td>
                </tr>
                <tr>
                    <th scope="row">ID of product</th>
                    <td><input type="text" value="<?php echo $row['idproduct'] ?>" name="masp"></td>
                </tr>
                <tr>
                    <th scope="row">Price</th>
                    <td><input type="text" value="<?php echo $row['price'] ?>" name="giasp"></td>
                </tr>
                <tr>
                    <th scope="row">Quantity</th>
                    <td><input type="text" value="<?php echo $row['quantity'] ?>" name="soluong"></td>
                </tr>

                <tr>
                    <th scope="row">Category</th>
                    <td>
                        <select name="danhmuc">
                            <?php
                            $sql_danhmuc = "SELECT * FROM category ORDER BY category_id DESC";
                            $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                            while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                                if($row_danhmuc['category_id'] == $row['category_id']) {
                            ?>
                                <option selected value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                            <?php } else{?>
                                <option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                            <?php }?>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Genre</th>
                    <td>
                        <select name="theloai">
                            <?php
                            $sql_theloai = "SELECT * FROM genres ORDER BY genre_id DESC";
                            $query_theloai = mysqli_query($mysqli, $sql_theloai);
                            while ($row_theloai = mysqli_fetch_array($query_theloai)) {
                                if($row_theloai['genre_id'] == $row['genre_id']) {
                            ?>
                                <option selected value="<?php echo $row_theloai['genre_id'] ?>"><?php echo $row_theloai['genre_name'] ?></option>
                            <?php } else{?>
                                <option value="<?php echo $row_theloai['genre_id'] ?>"><?php echo $row_theloai['genre_name'] ?></option>
                            <?php }?>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Description</th>
                    <td><textarea name="noidung" rows="5" cols="40" style="resize: none;"><?php echo $row['descriptions'] ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row">Thumnail</th>
                    <td>
                        <input type="file" name="hinhanh" id="image">
                        <img src="modules/manageproduct/uploads/<?php echo $row['thumbnail'] ?>" alt="" style="width: 150px; ">
                        <h3>New image</h3>
                        <div style="margin: 20px;" id="preview"></div>
                    </td>

                </tr>
                <!-- <tr>
                    <th scope="row">Release Date</th>
                    <td><input type="text" name="ngayramat"></td>
                </tr> -->
                <tr>
                    <th scope="row">Console Type</th>
                    <td><input type="text" value="<?php echo $row['console_type'] ?>" name="hemaysp"></td>
                </tr>
                <tr>
                    <th scope="row">Language</th>
                    <td><input type="text" value="<?php echo $row['languages'] ?>" name="ngonngusp"></td>
                </tr>
                <tr>
                    <th scope="row">Player</th>
                    <td><input type="text" value="<?php echo $row['player'] ?>" name="songuoichoi"></td>
                </tr>
                <tr>
                    <th scope="row">Publisher</th>
                    <td><input type="text" value="<?php echo $row['publisher_name'] ?>" name="nhaxuatban"></td>
                </tr>
                <tr>
                    <th scope="row">ESRB</th>
                    <td>
                        <select name="dotuoi">
                            <?php if ($row['esrb'] == 1) { ?>
                                <option value="1" selected>EARLYCHILDHOOD</option>
                                <option value="2">EVERYONE</option>
                                <option value="3">EVERYONE 10+</option>
                                <option value="4">TEEN</option>
                                <option value="5">MATURE 17+</option>
                                <option value="6">ADULTS ONLY 18+</option>
                            <?php } elseif ($row['esrb'] == 2) { ?>
                                <option value="1">EARLYCHILDHOOD</option>
                                <option value="2" selected>EVERYONE</option>
                                <option value="3">EVERYONE 10+</option>
                                <option value="4">TEEN</option>
                                <option value="5">MATURE 17+</option>
                                <option value="6">ADULTS ONLY 18+</option>
                            <?php } elseif ($row['esrb'] == 3) { ?>
                                <option value="1">EARLYCHILDHOOD</option>
                                <option value="2">EVERYONE</option>
                                <option value="3" selected>EVERYONE 10+</option>
                                <option value="4">TEEN</option>
                                <option value="5">MATURE 17+</option>
                                <option value="6">ADULTS ONLY 18+</option>
                            <?php } elseif ($row['esrb'] == 4) { ?>
                                <option value="1">EARLYCHILDHOOD</option>
                                <option value="2">EVERYONE</option>
                                <option value="3">EVERYONE 10+</option>
                                <option value="4" selected>TEEN</option>
                                <option value="5">MATURE 17+</option>
                                <option value="6">ADULTS ONLY 18+</option>
                            <?php } elseif ($row['esrb'] == 5) { ?>
                                <option value="1">EARLYCHILDHOOD</option>
                                <option value="2">EVERYONE</option>
                                <option value="3">EVERYONE 10+</option>
                                <option value="4">TEEN</option>
                                <option value="5" selected>MATURE 17+</option>
                                <option value="6">ADULTS ONLY 18+</option>
                            <?php } else { ?>
                                <option value="1">EARLYCHILDHOOD</option>
                                <option value="2">EVERYONE</option>
                                <option value="3">EVERYONE 10+</option>
                                <option value="4">TEEN</option>
                                <option value="5">MATURE 17+</option>
                                <option value="6" selected>ADULTS ONLY 18+</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>
                        <select name="tinhtrang">
                            <?php
                            if ($row['statuspr'] == 1) {
                            ?>
                                <option value="1" selected>Activate</option>
                                <option value="0">Hide</option>
                            <?php } else { ?>
                                <option value="1">Activate</option>
                                <option value="0" selected>Hide</option>
                            <?php } ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><input type="submit" name="suasanpham" value="Modified product"></th>
                    <td></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </form>
</table>