<?php
include('../../config/config.php');
$tensanpham = $_POST['tendanhmuc'];
$masp = $_POST['masp'];
$giasp = $_POST['giasp'];
$soluong = $_POST['soluong'];
$noidung = $_POST['noidung'];
$hemaysp = $_POST['hemaysp'];
$ngonngusp = $_POST['ngonngusp'];
$songuoichoi = $_POST['songuoichoi'];
$nhaxuatban = $_POST['nhaxuatban'];
$tinhtrang = $_POST['tinhtrang'];
$dotuoi = $_POST['dotuoi'];
// xuly hinh anh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time().'_'.$hinhanh;

if(isset($_POST['themsanpham']))
{
    //them
    $spl_them = "INSERT INTO product(name_product,idproduct,thumbnail,descriptions,console_type,languages,player,price,quantity,publisher_name,statuspr,esrb) VALUE('".$tensanpham."','".$masp."','".$hinhanh."','".$noidung."','".$hemaysp."','".$ngonngusp."','".$songuoichoi."','".$giasp."','".$soluong."','".$nhaxuatban."','".$tinhtrang."','".$dotuoi."')";
    mysqli_query($mysqli,$spl_them);
    move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
    header('Location:../../index.php?action=manageproducts&query=add');
}
elseif(isset($_POST['suasanpham']))
{
    //sua
    $spl_update = "UPDATE category SET category_name='".$tenloaisp."',category_ordinalnumber='".$thutu."' WHERE category_id='$_GET[iddanhmuc]'";
    mysqli_query($mysqli,$spl_update);
    header('Location:../../index.php?action=managecategory&query=add');
}
else
{
    $id = $_GET['iddanhmuc'];
    $sql_xoa = "DELETE FROM category WHERE category_id ='".$id."'";
    mysqli_query($mysqli,$sql_xoa);
    header('Location:../../index.php?action=managecategory&query=add');
}

?>