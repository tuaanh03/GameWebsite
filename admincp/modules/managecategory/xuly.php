<?php
include('../../config/config.php');
if (isset($_POST['themdanhmuc']) || isset($_POST['suadanhmuc'])) {
    $tenloaisp = $_POST['tendanhmuc'];
    $thutu = $_POST['thutu'];
}

if (isset($_POST['themdanhmuc'])) {
    //them
    $spl_them = "INSERT INTO category(category_name,category_ordinalnumber) VALUE('" . $tenloaisp . "','" . $thutu . "')";
    mysqli_query($mysqli, $spl_them);
    header('Location:../../index.php?action=managecategory&query=add');
} elseif (isset($_POST['suadanhmuc'])) {
    //sua
    $spl_update = "UPDATE category SET category_name='" . $tenloaisp . "',category_ordinalnumber='" . $thutu . "' WHERE category_id='$_GET[iddanhmuc]'";
    mysqli_query($mysqli, $spl_update);
    header('Location:../../index.php?action=managecategory&query=add');
} else {
    $id = $_GET['iddanhmuc'];
    $sql_xoa = "DELETE FROM category WHERE category_id ='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location:../../index.php?action=managecategory&query=add');
}
