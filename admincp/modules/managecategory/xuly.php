<?php
include('../../config/config.php');
$tenloaisp = $_POST['tendanhmuc'];
$thutu = $_POST['thutu'];
if(isset($_POST['themdanhmuc']))
{
    //them
    $spl_them = "INSERT INTO genres(genre_name,ordinalnumber) VALUE('".$tenloaisp."','".$thutu."')";
    mysqli_query($mysqli,$spl_them);
    header('Location:../../index.php?action=managecategory&query=add');
}
elseif(isset($_POST['suadanhmuc']))
{
    //sua
    $spl_update = "UPDATE genres SET genre_name='".$tenloaisp."',ordinalnumber='".$thutu."' WHERE genre_id='$_GET[iddanhmuc]'";
    mysqli_query($mysqli,$spl_update);
    header('Location:../../index.php?action=managecategory&query=add');
}
else
{
    $id = $_GET['iddanhmuc'];
    $sql_xoa = "DELETE FROM genres WHERE genre_id ='".$id."'";
    mysqli_query($mysqli,$sql_xoa);
    header('Location:../../index.php?action=managecategory&query=add');
}

?>