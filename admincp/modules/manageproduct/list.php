<?php
$sql_lietke_danhmucsp = "SELECT * FROM category ORDER BY category_ordinalnumber DESC";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
?>

<p>List the category</p>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">Name product</th>
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
                <td><?php echo $row['category_name'] ?></td>
                <td>
                    <a href="modules/managecategory/xuly.php?iddanhmuc=<?php echo $row['category_id'] ?>">Delete</a> | <a href="?action=managecategory&query=modified&iddanhmuc=<?php echo $row['category_id'] ?>">Modified</a>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>