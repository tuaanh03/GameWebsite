<?php
include('../../config/config.php');
$tenloaisp = $_POST['tendanhmuc'];
$thutu = $_POST['thutu'];
if(isset($_POST['themdanhmuc']))
{
    $spl_them = "INSERT INTO genres(genre_name,ordinalnumber) VALUE('".$tenloaisp."','".$thutu."')";
    mysqli_query($mysqli,$spl_them);
    header('Location:../../index.php?action=managecategory');
}
?>