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