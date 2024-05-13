<?php
include('../../config/config.php');

if (isset($_POST['themtheloai']) || isset($_POST['suatheloai'])) {
    $tentheloai = $_POST['tentheloai'];
    $thutu = $_POST['thutu'];
}
if (isset($_POST['themtheloai'])) {
    //them
    $spl_them = "INSERT INTO genres(genre_name,genre_ordinalnumber) VALUE('" . $tentheloai . "','" . $thutu . "')";
    mysqli_query($mysqli, $spl_them);
    header('Location:../../index.php?action=managegenres&query=add');
} elseif (isset($_POST['suatheloai'])) {
    //sua
    $spl_update = "UPDATE genres SET genre_name='" . $tentheloai . "',genre_ordinalnumber='" . $thutu . "' WHERE genre_id='$_GET[idtheloai]'";
    mysqli_query($mysqli, $spl_update);
    header('Location:../../index.php?action=managegenres&query=add');
} else {
    $id = $_GET['idtheloai'];
    $sql_xoa = "DELETE FROM genres WHERE genre_id ='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location:../../index.php?action=managegenres&query=add');
}
