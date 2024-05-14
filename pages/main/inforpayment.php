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


                                    <?php echo $cart_item['quantity'] ?>


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
            <div class="form-check">
                <input type="radio" name="payment" value="cash">
                <img src="images/money.png" height="50" width="50" alt="">
                <label for="html">Cash</label><br>
            </div>
            <div class="form-check">
                <input type="radio" name="payment" value="transfer">
                <img src="images/transfer.png" height="50" width="50" alt="">
                <label for="html">Transfer</label><br>
                <div id="transfer-info" style="display: none; background-color:aliceblue; text-align:center;">
                    <!-- Thông tin chuyển khoản -->
                    <h2>Transfer Information</h2>
                    <h4>Bank No: 0123456789</h4>
                    <h4>Name: Ngo Tuan Anh</h4>
                    <h4>Bank Name: Vietcombank </h4>

                </div>
            </div>

            <div class="form-check">
                <input type="radio" name="payment" value="momo">
                <img src="images/momo.png" height="50" width="50" alt="">
                <label for="javascript">VNPAY</label>
                <div id="momo-info" style="display: none; background-color:aliceblue; text-align:center;">
                    <!-- Thông tin chuyển khoản -->
                    <h2>Transfer Information</h2>
                    <h4>Momo No: 0123456789</h4>
                    <h4>Name: Ngo Tuan Anh</h4>
                    
                </div>
            </div>


            <p>Total money: <?php echo number_format($total_money) . 'đ';  ?></p>
            <button name="redirect" type="submit" class="btn btn-danger">Pay now</button>
        </div>
    </form>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lắng nghe sự kiện khi người dùng thay đổi phương thức thanh toán
        var paymentRadios = document.querySelectorAll('input[name="payment"]');
        paymentRadios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                // Kiểm tra xem radio được chọn có giá trị là "transfer" không
                if (this.value === 'transfer') {
                    // Nếu là "transfer", hiển thị phần tử chứa thông tin chuyển khoản
                    document.getElementById('transfer-info').style.display = 'block';
                } else {
                    // Nếu không phải "transfer", ẩn phần tử chứa thông tin chuyển khoản
                    document.getElementById('transfer-info').style.display = 'none';
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lắng nghe sự kiện khi người dùng thay đổi phương thức thanh toán
        var paymentRadios = document.querySelectorAll('input[name="payment"]');
        paymentRadios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                // Kiểm tra xem radio được chọn có giá trị là "transfer" không
                if (this.value === 'momo') {
                    // Nếu là "transfer", hiển thị phần tử chứa thông tin chuyển khoản
                    document.getElementById('momo-info').style.display = 'block';
                } else {
                    // Nếu không phải "transfer", ẩn phần tử chứa thông tin chuyển khoản
                    document.getElementById('momo-info').style.display = 'none';
                }
            });
        });
    });
</script>