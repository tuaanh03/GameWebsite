<?php
$sql_lietke_danhmucsp = "SELECT * FROM genres ORDER BY ordinalnumber DESC";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
?>

<p>List the category</p>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">Name of category</th>
            <th scope="row">Manage</th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) {
            $i++;
        ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['genre_name'] ?></td>
                <td>
                    <a href="modules/managecategory/xuly.php?iddanhmuc=<?php echo $row['genre_id'] ?>">Delete</a> | <a href="?action=managecategory&query=modified&iddanhmuc=<?php echo $row['genre_id'] ?>">Modified</a>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>