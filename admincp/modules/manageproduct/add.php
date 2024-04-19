<p>Add product</p>
<table class="table">
    <form action="modules/manageproduct/xuly.php" method="POST" enctype="multipart/form-data">
        <tbody>
            <tr>
                <th scope="row">Name of product</th>
                <td><input type="text" name="tensanpham"></td>
            </tr>
            <tr>
                <th scope="row">ID of product</th>
                <td><input type="text" name="masp"></td>
            </tr>
            <tr>
                <th scope="row">Price</th>
                <td><input type="text" name="giasp"></td>
            </tr>
            <tr>
                <th scope="row">Quantity</th>
                <td><input type="text" name="soluong"></td>
            </tr>  
            
            <tr>
                <th scope="row">Category</th>
                <td>
                    <select name="danhmuc" >
                        <?php
                        $sql_danhmuc = "SELECT * FROM category ORDER BY category_id DESC";
                        $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc); 
                        while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
                        ?>
                        <option value="<?php echo $row_danhmuc['category_id']?>"><?php echo $row_danhmuc['category_name']?></option>
                        <?php }?>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row">Genre</th>
                <td>
                    <select name="theloai" >
                        <?php
                        $sql_theloai = "SELECT * FROM genres ORDER BY genre_id DESC";
                        $query_theloai = mysqli_query($mysqli,$sql_theloai); 
                        while($row_theloai = mysqli_fetch_array($query_theloai)){
                        ?>
                        <option value="<?php echo $row_theloai['genre_id']?>"><?php echo $row_theloai['genre_name']?></option>
                        <?php }?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <th scope="row">Description</th>
                <td><textarea name="noidung" rows="5" cols="40" style="resize: none;"></textarea></td>
            </tr>
            <tr>
                <th scope="row">Thumnail</th>
                <td><input type="file" name="hinhanh"></td>
            </tr>
            <tr>
                <th scope="row">Release Date</th>
                <td><input type="text" name="ngayramat"></td>
            </tr>
            <tr>
                <th scope="row">Console Type</th>
                <td><input type="text" name="hemaysp"></td>
            </tr>
            <tr>
                <th scope="row">Language</th>
                <td><input type="text" name="ngonngusp"></td>
            </tr>
            <tr>
                <th scope="row">Player</th>
                <td><input type="text" name="songuoichoi"></td>
            </tr>
            <tr>
                <th scope="row">Publisher</th>
                <td><input type="text" name="nhaxuatban"></td>
            </tr>
            <tr>
                <th scope="row">ESRB</th>
                <td>
                    <select name="dotuoi" >
                        <option value="1">EARLYCHILDHOOD</option>
                        <option value="2">EVERYONE</option>
                        <option value="3">EVERYONE 10+</option>
                        <option value="4">TEEN</option>
                        <option value="5">MATURE 17+</option>
                        <option value="6">ADULTS ONLY 18+</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">Status</th>
                <td>
                    <select name="tinhtrang" >
                        <option value="1">Activate</option>
                        <option value="0">Hide</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><input type="submit" name="themsanpham" value="Add product"></th>
                <td></td>                
            </tr>
        </tbody>
    </form>
</table>