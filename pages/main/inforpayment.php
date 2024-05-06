<p>Information of payment</p>
<div class="container">
    <!-- Responsive Arrow Progress Bar -->
    <div class="arrow-steps clearfix">
        <div class="step done"> <span> <a href="index.php?manage=carts">Cart</a></span> </div>
        <div class="step done"> <span><a href="index.php?manage=shipping">Shipping</a></span> </div>
        <div class="step current"> <span><a href="index.php?manage=payment">Payment</a><span> </div>
        <div class="step"> <span><a href="index.php?manage=alreadyorder">History Bill</a><span> </div>
    </div>
    <form action="pages/main/handlepayment.php" method="POST">
        <div class="row">
            <?php
            $id_dangky = $_SESSION['id_khachhang'];
            $sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE customer_id = '$id_dangky' ORDER BY id_shipping DESC LIMIT 1");
            $count = mysqli_num_rows($sql_get_vanchuyen);
            if ($count > 0) {
                $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
                $name = $row_get_vanchuyen['name'];
                $phone = $row_get_vanchuyen['phone'];
                $province = $row_get_vanchuyen['province'];
                $district = $row_get_vanchuyen['district'];
                $ward = $row_get_vanchuyen['ward'];
                $address = $row_get_vanchuyen['address'];
                $note = $row_get_vanchuyen['note'];
            } else {
                $name = '';
                $phone = '';
                $address = '';
                $note = '';
            }
            ?>
            <div class="col-md-4" style="width: 100%;">
                <ul style="line-height:1.8">
                    <li style="color:black;">Fullname: <span style="font-weight: bold; "><?php echo $name ?></span></li>
                    <li style="color:black;">Phone number: <span style="font-weight: bold;"><?php echo $phone ?></span></li>
                    <li style="color:black;">Address: <span style="font-weight: bold;"><?php echo $address ?>,<?php echo $ward ?>, <?php echo $district ?>, <?php echo $province ?> </span></li>
                    <li style="color:black;">Note: <span style="font-weight: bold;"><?php echo $note ?></span></li>
                </ul>
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
                $total_money = 0;
                if (isset($_SESSION['cart'])) {
                    $thanhtien = 0;

                    foreach ($_SESSION['cart'] as $cart_item) {
                        $thanhtien = $cart_item['quantity'] * $cart_item['price'];
                        $total_money += $thanhtien;

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

        </div>
        <div class="col-md-4" style="float: right;">
            <h4>Payment Methods</h4>
            <input type="radio" name="payment" value="cash">
            <label for="html">Cash</label><br>
            <input type="radio" name="payment" value="transfer">
            <label for="html">Transfer</label><br>
            <input type="radio" name="payment" value="momo">
            <label for="css">MOMO</label><br>
            <input type="radio" name="payment" value="vnpay">
            <label for="javascript">VNPAY</label>
            <p>Total money: <?php echo number_format($total_money) . 'đ';  ?></p>
            <button name="redirect" type="submit" class="btn btn-danger">Pay now</button>
        </div>
    </form>
</div>