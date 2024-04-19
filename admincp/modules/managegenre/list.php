<?php
$sql_lietke_theloai = "SELECT * FROM genres ORDER BY genre_ordinalnumber DESC";
$query_lietke_theloai = mysqli_query($mysqli, $sql_lietke_theloai);
?>

<p>List the genres</p>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">Name of genres</th>
            <th scope="row">Manage</th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_theloai)) {
            $i++;
        ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['genre_name'] ?></td>
                <td>
                    <a href="modules/managegenre/xuly.php?idtheloai=<?php echo $row['genre_id'] ?>">Delete</a> | <a href="?action=managegenres&query=modified&idtheloai=<?php echo $row['genre_id'] ?>">Modified</a>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>