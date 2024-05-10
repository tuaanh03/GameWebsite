<?php
session_start();
include('../../admincp/config/config.php');

//themsoluongsanpham
if (isset($_GET['plus'])) {
    $id = $_GET['plus'];
    $sql_limited = "SELECT * FROM product WHERE product_id = '" . $id . "' LIMIT 1 ";
    $query_limited = mysqli_query($mysqli, $sql_limited);
    $row_limited = mysqli_fetch_array($query_limited);
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'name_product' => $cart_item['name_product'], 'id' => $cart_item['id'], 'quantity' => $cart_item['quantity'], 'price' => $cart_item['price'], 'thumbnail' => $cart_item['thumbnail'], 'idproduct' => $cart_item['idproduct']
            );
            $_SESSION['cart'] = $product;
        }
        else{
            $tangsoluong = $cart_item['quantity'] + 1;
           
            if($cart_item['quantity'] < 10 && $cart_item['quantity'] < $row_limited['quantity'] )
            {
                $product[] = array(
                    'name_product' => $cart_item['name_product'], 'id' => $cart_item['id'], 'quantity' =>$tangsoluong, 'price' => $cart_item['price'], 'thumbnail' => $cart_item['thumbnail'], 'idproduct' => $cart_item['idproduct']
                );
            }
            else
            {
                $product[] = array(
                    'name_product' => $cart_item['name_product'], 'id' => $cart_item['id'], 'quantity' =>$cart_item['quantity'], 'price' => $cart_item['price'], 'thumbnail' => $cart_item['thumbnail'], 'idproduct' => $cart_item['idproduct']
                );
            }
            $_SESSION['cart'] = $product;
            // echo $cart_item['quantity'];
            // echo $row_limited['quantity'];
            if ($cart_item['quantity'] > $row_limited['quantity']) {
                ?>
                <script>
                    alert('Chỉ còn <?php echo $row_limited['quantity'] ?> sản phẩm trong kho');
                </script>
                <?php
            }
        }
    }
    header('Location:../../index.php?manage=carts&quantity=' . $row_limited['quantity']);
}

//trusoluongsanpham
if (isset($_GET['minus'])) {
    $id = $_GET['minus'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'name_product' => $cart_item['name_product'], 'id' => $cart_item['id'], 'quantity' => $cart_item['quantity'], 'price' => $cart_item['price'], 'thumbnail' => $cart_item['thumbnail'], 'idproduct' => $cart_item['idproduct']
            );
            $_SESSION['cart'] = $product;
        }
        else{
            $tangsoluong = $cart_item['quantity'] - 1;
            if($cart_item['quantity']>1)
            {
                $product[] = array(
                    'name_product' => $cart_item['name_product'], 'id' => $cart_item['id'], 'quantity' =>$tangsoluong, 'price' => $cart_item['price'], 'thumbnail' => $cart_item['thumbnail'], 'idproduct' => $cart_item['idproduct']
                );
            }
            else
            {
                $product[] = array(
                    'name_product' => $cart_item['name_product'], 'id' => $cart_item['id'], 'quantity' =>$cart_item['quantity'], 'price' => $cart_item['price'], 'thumbnail' => $cart_item['thumbnail'], 'idproduct' => $cart_item['idproduct']
                );
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('Location:../../index.php?manage=carts');
}

//xóa từng sản phẩm
if (isset($_SESSION['cart']) && isset($_GET['delete'])) {
    $id =  $_GET['delete'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'name_product' => $cart_item['name_product'], 'id' => $cart_item['id'], 'quantity' => $cart_item['quantity'], 'price' => $cart_item['price'], 'thumbnail' => $cart_item['thumbnail'], 'idproduct' => $cart_item['idproduct']
            );
        }
    }
    $_SESSION['cart'] = $product;
    header('Location:../../index.php?manage=carts');
}

// xóa tất cả
if (isset($_GET['deleteall']) && $_GET['deleteall'] == 1) {
    unset($_SESSION['cart']);
    header('Location:../../index.php?manage=carts');
}

// thêm sản phẩm vào giỏ hàng
if (isset($_POST['themgiohang'])) {
    // session_destroy();
    $id = $_GET['idsanpham'];
    $soluong = $_POST['quantitycart'];
    $sql = "SELECT * FROM product WHERE product_id = '" . $id . "' LIMIT 1 ";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    if ($row) {
        $new_product = array(array(
            'name_product' => $row['name_product'], 'id' => $id, 'quantity' => $soluong, 'price' => $row['price'], 'thumbnail' => $row['thumbnail'], 'idproduct' => $row['idproduct']
        ));
        if (isset($_SESSION['cart'])) {
            $found = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                if ($cart_item['id'] == $id) {
                    if($cart_item['quantity'] < 10 && $cart_item['quantity'] < $row_limited['quantity'] )
                    {
                        $product[] = array(
                            'name_product' => $cart_item['name_product'], 'id' => $cart_item['id'], 'quantity' => $cart_item['quantity'] + $soluong, 'price' => $cart_item['price'], 'thumbnail' => $cart_item['thumbnail'], 'idproduct' => $cart_item['idproduct']
                        );
                    }
                    else
                    {
                        $product[] = array(
                            'name_product' => $cart_item['name_product'], 'id' => $cart_item['id'], 'quantity' => $cart_item['quantity'], 'price' => $cart_item['price'], 'thumbnail' => $cart_item['thumbnail'], 'idproduct' => $cart_item['idproduct']
                        );
                    }
                    
                    $found = true;
                } else {
                    $product[] = array(
                        'name_product' => $cart_item['name_product'], 'id' => $cart_item['id'], 'quantity' => $cart_item['quantity'], 'price' => $cart_item['price'], 'thumbnail' => $cart_item['thumbnail'], 'idproduct' => $cart_item['idproduct']
                    );
                }
            }
            if ($found == false) {
                $_SESSION['cart'] = array_merge($product, $new_product);
            } else {
                $_SESSION['cart'] = $product;
            }
        } else {
            $_SESSION['cart'] = $new_product;
        }
    }
    header('Location:../../index.php?manage=carts');
}

