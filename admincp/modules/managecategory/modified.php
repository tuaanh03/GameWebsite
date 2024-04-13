<?php
$sql_sua_danhmucsp = "SELECT * FROM genres WHERE genre_id ='$_GET[iddanhmuc]' LIMIT 1";
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
                <td><input type="text" value="<?php echo $dong['genre_name'] ?>" name="tendanhmuc"></td>
            </tr>
            <tr>
                <th scope="row">NumberOrdinal</th>
                <td><input type="text" value="<?php echo $dong['ordinalnumber'] ?>" name="thutu"></td>
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