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


// xử lý thêm
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

  
        
 // xử lý cập nhật       
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
        if ($address == '') {
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
                    <label for="exampleInputPassword1">Province</label>
                    <select name="province" id="province" class="form-control">
                        <option value="" disabled selected>Select Province / City</option>
                        <!-- Added options for cities -->
                        <option value="TP Hồ Chí Minh">TP Hồ Chí Minh</option>
                        <option value="Hà Nội">Hà Nội</option>
                        <!-- Add other cities here if needed -->
                    </select>
                </div>

                <div class="form-group" style="margin-top: 25px;">
                    <label for="exampleInputPassword1">District</label>
                    <select name="district" id="district" class="form-control">
                        <option value="" disabled selected>Select district</option>
                    </select>
                </div>

                <div class="form-group" style="margin-top: 25px;">
                    <label for="exampleInputPassword1">Ward</label>
                    <select name="ward" id="ward" class="form-control">
                        <option value="" disabled selected>Select ward</option>
                    </select>
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



<script>
    var cities = {
        "TP Hồ Chí Minh": ["Quận 1", "Quận 2", "Quận 3", "Quận 4", "Quận 5", "Quận 6", "Quận 7", "Quận 8", "Quận 9", "Quận 10", "Quận 11", "Quận 12", "Gò Vấp", "Bình Tân", "Cần Giờ", "Bình Chánh"],
        "Hà Nội": ["Ba Đình", "Hoàn Kiếm", "Long Biên", "Tây Hồ", ]
    };

    // Lắng nghe sự kiện khi select box của thành phố thay đổi
    document.getElementById("province").addEventListener("change", function() {
        var selectedCity = this.value; // Lấy giá trị của thành phố đã chọn
        var districts = getDistricts(selectedCity); // Lấy danh sách các quận huyện tương ứng

        // Làm sạch select box của quận huyện trước khi cập nhật
        var districtSelect = document.getElementById("district");
        districtSelect.innerHTML = "<option value='' disabled selected>Select district</option>";

        // Thêm các quận huyện vào select box
        districts.forEach(function(district) {
            var option = document.createElement("option");
            option.text = district;
            option.value = district;
            districtSelect.appendChild(option);
        });
    });

    // Hàm trả về danh sách các quận huyện của một thành phố cụ thể
    function getDistricts(city) {
        return cities[city] || []; // Trả về mảng các quận huyện của thành phố hoặc một mảng trống nếu không tìm thấy
    }


    // Mảng chứa thông tin về các phường, xã của mỗi quận
    var wards = {
        "Quận 1": ["Phường Tân Định", "Phường Đa Kao", "Phường Bến Nghé", "Phường Bến Thành", "Phường Nguyễn Thái Bình"],
        "Quận 2": ["Phường Thảo Điền", "Phường An Phú", "Phường Bình An", "Phường Bình Trưng Đông", "Phường Bình Trưng Tây"],
        "Quận 3": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Quận 4": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Quận 5": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Quận 6": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Quận 7": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Quận 8": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Quận 9": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Quận 10": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        // Thêm thông tin cho các quận còn lại
        "Quận 11": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Quận 12": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Bình Tân": ["Phường Bình Trị Đông", "Phường Bình Trị Đông A", "Phường Bình Hưng Hòa", "Phường Bình Hưng Hoà A", "Phường Bình Hưng Hoà B"],
        "Bình Thạnh": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Gò Vấp": ["Phường 1", "Phường 2", "Phường 3", "Phường 4", "Phường 5"],
        "Bình Chánh": ["Xã Bình Chánh 1", "Xã Bình Chánh 2", "Xã Bình Chánh 3", "Xã Bình Chánh 4", "Xã Bình Chánh 5"],
        "Cần Giờ": ["Xã Cần Giờ 1", "Xã Cần Giờ 2", "Xã Cần Giờ 3", "Xã Cần Giờ 4", "Xã Cần Giờ 5"],
        "Ba Đình": ["Phường Trúc Bạch", "Phường Vĩnh Phúc", "Phường Cống Vị", "Phường Liễu Giai", "Phường Nguyễn Trung Trực"],
        "Hoàn Kiếm": ["Phường Phúc Tân", "Phường Đồng Xuân", "Phường Hàng Gai", "Phường Hàng Bạc", "Phường Hàng Bồ"],
        "Tây Hồ": ["Phường Quảng An", "Phường Xuân La", "Phường Yên Phụ", "Phường Thụy Khuê", "Phường Tây Hồ"],
        "Long Biên": ["Phường Thượng Thanh", "Phường Ngọc Thụy", "Phường Bồ Đề", "Phường Sài Đồng", "Phường Gia Thụy"],
    };

    // Lắng nghe sự kiện khi select box của quận thay đổi
    document.getElementById("district").addEventListener("change", function() {
        var selectedDistrict = this.value; // Lấy giá trị của quận đã chọn
        var wardsInDistrict = getWards(selectedDistrict); // Lấy danh sách các phường, xã tương ứng

        // Làm sạch select box của phường, xã trước khi cập nhật
        var wardSelect = document.getElementById("ward");
        wardSelect.innerHTML = "<option value='' disabled selected>Select ward</option>";

        // Thêm các phường, xã vào select box
        wardsInDistrict.forEach(function(ward) {
            var option = document.createElement("option");
            option.text = ward;
            option.value = ward;
            wardSelect.appendChild(option);
        });
    });




    // Hàm trả về danh sách các phường, xã của một quận cụ thể
    function getWards(district) {
        return wards[district] || []; // Trả về mảng các phường, xã của quận hoặc một mảng trống nếu không tìm thấy
    }
</script>