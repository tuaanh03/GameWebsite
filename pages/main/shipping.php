<p>Vận chuyển</p>
<div class="container">
    <!-- Responsive Arrow Progress Bar -->
    <div class="arrow-steps clearfix">
        <div class="step done"> <span> <a href="index.php?manage=carts">Cart</a></span> </div>
        <div class="step current"> <span><a href="index.php?manage=shipping">Shipping</a></span> </div>
        <div class="step"> <span><a href="index.php?manage=payment">Payment</a><span> </div>
        <div class="step"> <span><a href="index.php?manage=alreadyorder">History Bill</a><span> </div>
    </div>
    <h4>Information Shipping</h4>
    <?php
    if (isset($_POST['themvanchuyen'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        $id_dangky = $_SESSION['id_khachhang'];
        $sql_them_vanchuyen = "INSERT INTO tbl_shipping(customer_id,name,phone,address,note) VALUES('$id_dangky','$name','$phone','$address','$note')";
        $query_them_vanchuyen = mysqli_query($mysqli, $sql_them_vanchuyen);
        if ($query_them_vanchuyen) {
            echo '<script>alert("Add shipping successfully !")</script>';
        }
    } elseif (isset($_POST['capnhatvanchuyen'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        $id_dangky = $_SESSION['id_khachhang'];
        $sql_update_vanchuyen = "UPDATE tbl_shipping SET customer_id='$id_dangky',name='$name',phone='$phone',address='$address',note='$note' WHERE customer_id = '$id_dangky' ";
        $query_update_vanchuyen = mysqli_query($mysqli, $sql_update_vanchuyen);
        if ($query_update_vanchuyen) {
            echo '<script>alert("Update shipping successfully !")</script>';
        }
    }
    ?>
    <div class="row">
        <?php
        $id_dangky = $_SESSION['id_khachhang'];
        $sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE customer_id = '$id_dangky' LIMIT 1");
        $count = mysqli_num_rows($sql_get_vanchuyen);
        if ($count > 0) {
            $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
            $name = $row_get_vanchuyen['name'];
            $phone = $row_get_vanchuyen['phone'];
            $address = $row_get_vanchuyen['address'];
            $note = $row_get_vanchuyen['note'];
        } else {
            $name = '';
            $phone = '';
            $address = '';
            $note = '';
        }
        if($address == '')
        {
            $address = $_SESSION['diachi'];
        }
        ?>
        <div class="col-md-4">
            <form action="" autocomplete="off" method="POST">

                <div class="form-group" style="margin-top: 25px;">
                    <label for="exampleInputEmail1">Họ và tên</label>
                    <input value="<?php echo $name ?>" type="text" name="name" class="form-control" placeholder="...">
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>

                <div class="form-group" style="margin-top: 25px;">
                    <label for="exampleInputPassword1">Phone</label>
                    <input value="<?php echo $phone ?>" type="text" name="phone" class="form-control" placeholder="...">
                </div>

                <div class="form-group" style="margin-top: 25px;">
                    <label for="exampleInputPassword1">Address</label>
                    <input value="<?php echo $address; ?>" type="text" name="address" class="form-control" placeholder="...">
                </div>

                <div class="form-group" style="margin-top: 25px;">
                    <label for="exampleInputPassword1">Note</label>
                    <input value="<?php echo $note ?>" type="text" name="note" class="form-control" placeholder="...">
                </div>
                <?php
                if ($name == '' && $phone == '') {
                ?>
                    <button style="margin-top: 25px;" name="themvanchuyen" type="submit" class="btn btn-primary">Add shipping</button>
                <?php } elseif ($name != '' && $phone != '') { ?>
                    <button style="margin-top: 25px;" name="capnhatvanchuyen" type="submit" class="btn btn-success">Update shipping</button>
                <?php } ?>
            </form>
        </div>
        <!-- -----------Giỏ hàng---------- -->
        <table class="cart">
            <thead>
                <tr>
                    <th class="product-name">Product Name</th>
                    <th class="product-price">Price</th>
                    <th class="product-qty">Quantity</th>
                    <th class="product-total">Total</th>

                </tr>
            </thead>
            <?php
            if (isset($_SESSION['cart'])) {
                $thanhtien = 0;

                foreach ($_SESSION['cart'] as $cart_item) {
                    $thanhtien = $cart_item['quantity'] * $cart_item['price'];

            ?>
                    <tbody>
                        <tr>
                            <td class="product-name">
                                <div class="product-thumbnail">
                                    <img style="width: 150px;" src="admincp/modules/manageproduct/uploads/<?php echo $cart_item['thumbnail'] ?>" alt="">
                                </div>
                                <div class="product-detail" style="margin-top: 70px;">
                                    <h3 class="product-title"><?php echo $cart_item['name_product'] ?></h3>
                                </div>
                            </td>
                            <td class="product-price"><?php echo number_format($cart_item['price']) . '₫' ?></td>
                            <td class="product-qty">

                                <a class="btn btn-light" href="pages/main/addtocart.php?plus=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus"></i></a>
                                <?php echo $cart_item['quantity'] ?>
                                <a class="btn btn-light" href="pages/main/addtocart.php?minus=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus"></i></a>

                            </td>
                            <td class="product-total"><?php echo number_format($thanhtien) . 'đ'; ?></td>

                        </tr>
                    </tbody>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="6">
                        <p>Empty</p>
                    </td>
                </tr>
            <?php } ?>
        </table> <!-- .cart -->

        <a href="index.php?manage=payment" class="button" style="text-align: center;">Payment</a>

    </div>
</div>
