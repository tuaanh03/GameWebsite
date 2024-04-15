<?php
$sql_sua_danhmucsp = "SELECT * FROM category WHERE category_id ='$_GET[iddanhmuc]' LIMIT 1";
$query_sua_danhmucsp = mysqli_query($mysqli, $sql_sua_danhmucsp);
?>
<p>Modified category</p>
<table class="table">
    <form action="modules/managecategory/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>" method="POST">
        <tbody>
            <?php
            while($dong = mysqli_fetch_array($query_sua_danhmucsp)) {
            ?>
            <tr>
                <th scope="row">Name of Category</th>
                <td><input type="text" value="<?php echo $dong['category_name'] ?>" name="tendanhmuc"></td>
            </tr>
            <tr>
                <th scope="row">NumberOrdinal</th>
                <td><input type="text" value="<?php echo $dong['category_ordinalnumber'] ?>" name="thutu"></td>
            </tr>
            <tr>
                <th scope="row"><input type="submit" name="suadanhmuc" value="Modified product"></th>
                <td></td>

            </tr>
            <?php
            }
            ?>

        </tbody>

    </form>
</table>