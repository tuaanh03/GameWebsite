<?php
include('../../config/config.php');
$tensanpham = $_POST['tensanpham'];
$masp = $_POST['masp'];
$giasp = $_POST['giasp'];
$soluong = $_POST['soluong'];
$noidung = $_POST['noidung'];
$hemaysp = $_POST['hemaysp'];
$ngonngusp = $_POST['ngonngusp'];
$songuoichoi = $_POST['songuoichoi'];
$danhmuc = $_POST['danhmuc'];
$nhaxuatban = $_POST['nhaxuatban'];
$tinhtrang = $_POST['tinhtrang'];
$dotuoi = $_POST['dotuoi'];
// xuly hinh anh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time() . '_' . $hinhanh;

if (isset($_POST['themsanpham'])) {
    //them
    $spl_them = "INSERT INTO product(name_product,idproduct,thumbnail,descriptions,console_type,languages,player,category_id,price,quantity,publisher_name,statuspr,esrb) VALUE('" . $tensanpham . "','" . $masp . "','" . $hinhanh . "','" . $noidung . "','" . $hemaysp . "','" . $ngonngusp . "','" . $songuoichoi . "','" . $danhmuc . "','" . $giasp . "','" . $soluong . "','" . $nhaxuatban . "','" . $tinhtrang . "','" . $dotuoi . "')";
    mysqli_query($mysqli, $spl_them);
    move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
    header('Location:../../index.php?action=manageproducts&query=add');
} elseif (isset($_POST['suasanpham'])) {
    //sua
    if ($hinhanh != '') {
        $spl_update = "UPDATE product SET name_product='" . $tensanpham . "',idproduct='" . $masp . "',thumbnail='" . $hinhanh . "',descriptions='" . $noidung . "',console_type='" . $hemaysp . "',languages='" . $ngonngusp . "',player='" . $songuoichoi . "',category_id='" . $danhmuc . "',price='" . $giasp . "',quantity='" . $soluong . "',publisher_name='" . $nhaxuatban . "',statuspr='" . $tinhtrang . "',esrb='" . $dotuoi . "' WHERE product_id='$_GET[idsanpham]'";
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
        $id = $_GET['idsanpham'];
        $sql = "SELECT * FROM product WHERE product_id = '$id' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/' . $row['thumbnail']);
        }
    } else {
        $spl_update = "UPDATE product SET name_product='" . $tensanpham . "',idproduct='" . $masp . "',descriptions='" . $noidung . "',console_type='" . $hemaysp . "',languages='" . $ngonngusp . "',player='" . $songuoichoi . "',category_id='" . $danhmuc . "',price='" . $giasp . "',quantity='" . $soluong . "',publisher_name='" . $nhaxuatban . "',statuspr='" . $tinhtrang . "',esrb='" . $dotuoi . "' WHERE product_id='$_GET[idsanpham]'";
    }
    mysqli_query($mysqli, $spl_update);
    header('Location:../../index.php?action=manageproducts&query=add');
} else {
    $id = $_GET['idsanpham'];
    $sql = "SELECT * FROM product WHERE product_id = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['thumbnail']);
    }
    $sql_xoa = "DELETE FROM product WHERE product_id ='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location:../../index.php?action=manageproducts&query=add');
}
