<?php
$sql_sua_theloai = "SELECT * FROM genres WHERE genre_id ='$_GET[idtheloai]' LIMIT 1";
$query_sua_theloai = mysqli_query($mysqli, $sql_sua_theloai);
?>
<p>Modified genres</p>
<table class="table">
    <form action="modules/managegenre/xuly.php?idtheloai=<?php echo $_GET['idtheloai'] ?>" method="POST">
        <tbody>
            <?php
            while($dong = mysqli_fetch_array($query_sua_theloai)) {
            ?>
            <tr>
                <th scope="row">Name of genre</th>
                <td><input type="text" value="<?php echo $dong['genre_name'] ?>" name="tentheloai"></td>
            </tr>
            <tr>
                <th scope="row">NumberOrdinal</th>
                <td><input type="text" value="<?php echo $dong['genre_ordinalnumber'] ?>" name="thutu"></td>
            </tr>
            <tr>
                <th scope="row"><input type="submit" name="suatheloai" value="Modified genre"></th>
                <td></td>

            </tr>
            <?php
            }
            ?>

        </tbody>

    </form>
</table>