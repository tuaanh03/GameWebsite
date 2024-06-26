<p>Transportation</p>
<div class="container">
    <!-- Responsive Arrow Progress Bar -->
    <div class="arrow-steps clearfix">
        <div class="step done"> <span> <a href="index.php?manage=carts">Cart</a></span> </div>
        <div class="step current"> <span><a href="index.php?manage=shipping">Shipping</a></span> </div>
        <div class="step"> <span><a href="index.php?manage=payment">Payment</a><span> </div>
        <div class="step"> <span><a href="index.php?manage=alreadyorder">History Bill</a><span> </div>
    </div>
    <h4 style="margin-top: 20px;">Information Shipping</h4>
    <?php
   

    // xử lý thêm địa chỉ

    if (isset($_POST['themvanchuyen'])) {
        $id_dangky = $_SESSION['id_khachhang'];
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $province = isset($_POST['province']) ? $_POST['province'] : '';
        $district = isset($_POST['district']) ? $_POST['district'] : '';
        $ward = isset($_POST['ward']) ? $_POST['ward'] : '';
        $streetaddress = isset($_POST['streetaddress']) ? $_POST['streetaddress'] : '';
        $note = isset($_POST['note']) ? $_POST['note'] : '';
        $sql_them_vanchuyen = "INSERT INTO tbl_shipping(customer_id,name,phone,address,province,district,ward,note) VALUES('$id_dangky','$name','$phone',' $streetaddress','$province','$district','$ward','$note')";
        // $query_them_vanchuyen = mysqli_query($mysqli, $sql_them_vanchuyen); lỗi phần này
        $query_them_vanchuyen = mysqli_query($mysqli, $sql_them_vanchuyen);
        if ($query_them_vanchuyen) {
            echo '<script>alert("Add shipping successfully !")</script>';
        } else {
            echo '<script>alert("Failed to add shipping!")</script>';
        }
    } else {
        $name = '';
        $phone = '';
        $province = '';
        $district = '';
        $ward = '';
        $streetaddress = '';
    }



    // phần sử dụng địa chỉ có sẵn
    $id_dangky = $_SESSION['id_khachhang'];
    $sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_customer WHERE customer_id = '$id_dangky' LIMIT 1");
    $count = mysqli_num_rows($sql_get_vanchuyen);
    if ($count > 0) {
        $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
        $name = $row_get_vanchuyen['fullname'];
        $phone = $row_get_vanchuyen['phonenumber'];
        $email = $row_get_vanchuyen['email'];
        $province = $row_get_vanchuyen['customer_province'];
        $district = $row_get_vanchuyen['customer_district'];
        $ward = $row_get_vanchuyen['customer_ward'];
        $streetaddress = $row_get_vanchuyen['customer_address'];
    } else {
        $name = '';
        $phone = '';
        $email = '';
        $province = '';
        $district = '';
        $ward = '';
        $streetaddress = '';
    }




    // xử lý cập nhật     
    // elseif (isset($_POST['capnhatvanchuyen'])) {
    //     $name = $_POST['name'];
    //     $phone = $_POST['phone'];
    //     $address = $_POST['address'];
    //     $note = $_POST['note'];
    //     $id_dangky = $_SESSION['id_khachhang'];
    //     $sql_update_vanchuyen = "UPDATE tbl_shipping SET customer_id='$id_dangky',name='$name',phone='$phone',address='$address',note='$note' WHERE customer_id = '$id_dangky' ";
    //     $query_update_vanchuyen = mysqli_query($mysqli, $sql_update_vanchuyen);
    //     if ($query_update_vanchuyen) {
    //         echo '<script>alert("Update shipping successfully !")</script>';
    //     }
    // }
    // 
    ?>
    <script>
        function myFunction() {
            <?php
            if (!isset($_POST['themvanchuyen'])) {
            ?>
                alert('Please confirm your address first');
            <?php
            }
            ?>
        }
    </script>
    <div class="row">

        <p class="d-inline-flex gap-1">
            <?php if ($row_get_vanchuyen['fullname']) { ?>
                <a id="useDefaultAddressBtn" class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample" onclick="useDefaultAddress()" style="display: inline-block;">

                    Use default address

                </a>
                <a id="createNewAddressBtn" class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample" onclick="createNewAddress()" style="display: inline-block;">

                    Create new address
                </a>
            <?php } else {

            ?>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">

                    Create new address
                </a>
            <?php

            }  ?>


        </p>
        <div class="collapse" id="collapseExample1">
            <div class="card card-body">
                <h1>New Address</h1>
                <div class="col-md-5">
                    <form action="" autocomplete="off" method="POST">

                        


                        <div class="form-group" style="margin-top: 25px;">
                            <label for="exampleInputEmail1">Full name</label>
                            <input type="text" name="name" class="form-control" placeholder="...">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>

                        <div class="form-group" style="margin-top: 25px;">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="...">
                        </div>

                        <div class="form-group" style="margin-top: 25px;">
                            <label for="exampleInputPassword1">Province</label>
                            <select name="province" id="province" class="form-control">
                                <option value="" disabled selected>Select Province / City</option>

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
                            <label for="exampleInputPassword1">Street Address</label>
                            <input type="text" name="streetaddress" class="form-control" placeholder="...">
                        </div>



                        <button style="margin-top: 25px;" name="themvanchuyen" type="submit" class="btn btn-primary" onclick="return validateForm();">Confirm</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="collapse" id="collapseExample2">
            <div class="card card-body">
                <h1>Default Address</h1>
                <div class="col-md-5">
                    <form action="" autocomplete="off" method="POST">

                        

                        <div class="form-group" style="margin-top: 25px;">
                            <label for="exampleInputEmail1">Full name</label>
                            <input value="<?php echo $name ?>" type="text" name="name" class="form-control" placeholder="...">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>

                        <div class="form-group" style="margin-top: 25px;">
                            <label for="exampleInputPassword1">Phone</label>
                            <input value="<?php echo $phone ?>" type="text" name="phone" class="form-control" placeholder="...">
                        </div>

                        <div class="form-group" style="margin-top: 25px;">
                            <label for="exampleInputEmail1">Province</label>
                            <input value="<?php echo $province ?>" type="text" name="province" class="form-control" placeholder="...">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>

                        <div class="form-group" style="margin-top: 25px;">
                            <label for="exampleInputEmail1">District</label>
                            <input value="<?php echo $district ?>" type="text" name="district" class="form-control" placeholder="...">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>

                        <div class="form-group" style="margin-top: 25px;">
                            <label for="exampleInputEmail1">Ward</label>
                            <input value="<?php echo $ward ?>" type="text" name="ward" class="form-control" placeholder="...">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>

                        <div class="form-group" style="margin-top: 25px;">
                            <label for="exampleInputPassword1">Street Address</label>
                            <input value="<?php echo $streetaddress; ?>" type="text" name="streetaddress" class="form-control" placeholder="...">
                        </div>



                        <button style="margin-top: 25px;" name="themvanchuyen" type="submit" class="btn btn-primary">Confirm</button>

                    </form>
                </div>
            </div>
        </div>
        <?php if(isset($_POST['themvanchuyen'])) 
        {
            $sql_get_shipping = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE customer_id = '$id_dangky' ORDER BY id_shipping DESC LIMIT 1");
            $count_shipping = mysqli_num_rows($sql_get_shipping);
            if ($count_shipping > 0) {
                $row_get_shipping = mysqli_fetch_array($sql_get_shipping);
                $name_shipping = $row_get_shipping['name'];
                $phone_shipping = $row_get_shipping['phone'];
                $province_shipping = $row_get_shipping['province'];
                $district_shipping = $row_get_shipping['district'];
                $ward_shipping = $row_get_shipping['ward'];
                $address_shipping = $row_get_shipping['address'];
                $note_shipping = $row_get_shipping['note'];
            } else {
                $name_shipping = '';
                $phone_shipping = '';
                $address_shipping = '';
                $note_shipping = '';
            }
            ?>
            <div class="col-md-4" style="width: 100%;">
            <ul style="line-height:1.8">
                <h3>Selected address</h3>
                <li style="color:black;">Fullname: <span style="font-weight: bold; "><?php echo $name_shipping ?></span></li>
                <li style="color:black;">Phone number: <span style="font-weight: bold;"><?php echo $phone_shipping ?></span></li>
                <li style="color:black;">Address: <span style="font-weight: bold;"><?php echo $address_shipping ?>,<?php echo $ward_shipping ?>, <?php echo $district_shipping ?>, <?php echo $province_shipping ?> </span></li>
                <li style="color:black;">Note: <span style="font-weight: bold;"><?php echo $note_shipping ?></span></li>
            </ul>
        </div>
            <?php
        }
        ?>





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

        <a <?php if (isset($_POST['themvanchuyen'])) { ?> href="index.php?manage=payment" <?php } ?> class="button" style="text-align: center;" onclick="myFunction()">Payment</a>



    </div>
</div>








<script>
    document.addEventListener('DOMContentLoaded', function() {
        const citySelect = document.getElementById('province');
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');

        // Định nghĩa danh sách các thành phố và các quận theo thành phố
        const cities = {
            "Ho Chi Minh City": ["District 1", "District 2", "District 3", "District 4", "District 5", "District 6", "District 7", "District 8", "District 9", "District 10", "District 11", "District 12", "Go Vap", "Binh Tan", "Can Gio", "Binh Chanh", "Binh Thanh"],
            "Da Nang": ['Son Tra', 'Cam Le'],
            "Ha Noi": ["Ba Dinh", "Hoan Kiem", "Long Bien", "Tay Ho", ]
        };

        // Định nghĩa danh sách các phường theo quận
        const wardsByDistrict = {
            "District 1": ["Tan Dinh Ward", "Da Kao Ward", "Ben Nghe Ward", "Ben Thanh Ward", "Nguyen Thai Binh Ward"],
            "District 2": ["Thao Dien Ward", "An Phu Ward", "Binh An Ward", "Binh Trung Dong Ward", "Binh Trung Tay Ward"],
            "District 3": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "District 4": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "District 5": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "District 6": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "District 7": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "District 8": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "District 9": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "District 10": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            // Thêm thông tin cho các quận còn lại
            "District 11": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "District 12": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "Binh Tan": ["Binh Tri Dong Ward", "Binh Tri Dong A Ward", "Binh Hung Hoa Ward", "Binh Hung Hoa A Ward", "Binh Hung Hoa B Ward"],
            "Binh Thanh": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "Go Vap": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
            "Binh Chanh": ["Commune 1, Binh Chanh", "Commune 2, Binh Chanh", "Commune 3, Binh Chanh", "Commune 4, Binh Chanh", "Commune 5, Binh Chanh"],
            "Can Gio": ["Commune 1, Can Gio", "Commune 2, Can Gio", "Commune 3, Can Gio", "Commune 4, Can Gio", "Commune 5, Can Gio"],
            "Ba Dinh": ["Truc Bach Ward", "Vinh Phuc Ward", "Cong Vi Ward", "Lieu Giai Ward", "Nguyen Trung Truc Ward"],
            "Hoan Kiem": ["Phuc Tan Ward", "Dong Xuan Ward", "Hang Gai Ward", "Hang Bac Ward", "Hang Bo Ward"],
            "Tay Ho": ["Quang An Ward", "Xuan La Ward", "Yen Phu Ward", "Thuy Khue Ward", "Tay Ho Ward"],
            "Long Bien": ["Thuong Thanh Ward", "Ngoc Thuy Ward", "Bo De Ward", "Sai Dong Ward", "Gia Thuy Ward"],

            "Son Tra": ["Phuoc My Ward", "Tho Quang Ward"],
            "Cam Le": ["Hoa An Ward", "Hoa Xuan Ward"]
        };

        // Tạo các option cho dropdown thành phố
        Object.keys(cities).forEach(function(city) {
            const optionElem = document.createElement('option');
            optionElem.textContent = city;
            optionElem.value = city;
            citySelect.appendChild(optionElem);
        });

        // GIữ các option mặc định cho dropdown quận/huyện và phường/xã
        districtSelect.innerHTML = '<option value="">Select district</option>';
        wardSelect.innerHTML = '<option value="">Select ward</option>';

        // Xử lý sự kiện khi chọn thành phố
        citySelect.addEventListener('change', function() {
            const selectedCity = this.value;
            const districts = cities[selectedCity];
            populateDropdown(districtSelect, districts);
            clearDropdown(wardSelect);
        });

        // Xử lý sự kiện khi chọn quận
        districtSelect.addEventListener('change', function() {
            const selectedDistrict = this.value;
            if (selectedDistrict) {
                const wards = wardsByDistrict[selectedDistrict];
                populateDropdown(wardSelect, wards);
            } else {
                clearDropdown(wardSelect);
            }
        });

        // Hàm để điền các tùy chọn vào dropdown
        function populateDropdown(select, options) {
            // Xóa tất cả các tùy chọn hiện có trừ option đầu tiên
            clearDropdown(select);
            // Thêm các tùy chọn mới từ mảng options
            options.forEach(function(option) {
                const optionElem = document.createElement('option');
                optionElem.textContent = option;
                optionElem.value = option;
                select.appendChild(optionElem);
            });
        }

        // Hàm để xóa tất cả các tùy chọn trong dropdown
        function clearDropdown(select) {
            // Lưu trữ các tùy chọn mặc định
            const defaultOption = select.options[0];
            select.innerHTML = '';
            // Thêm lại các tùy chọn mặc định
            select.appendChild(defaultOption);
        }
    });
</script>




<script>
    function validateForm() {
        // Regular expression for phone number
        var phoneRegex = /^\d{10,11}$/; // Change the regex according to your requirements

        var name = document.querySelector("input[name='name']").value;
        var phone = document.querySelector("input[name='phone']").value;
        var province = document.querySelector("select[name='province']").value;
        var district = document.querySelector("select[name='district']").value;
        var ward = document.querySelector("select[name='ward']").value;
        var streetAddress = document.querySelector("input[name='streetaddress']").value;

        // Check if any field is empty or phone number is invalid
        if (!name || !phone || !province || !district || !ward || !streetAddress || !phoneRegex.test(phone)) {
            // Show error message
            alert("Please fill enough information !");
            return false; // Prevent form submission
        }
    }
</script>


<script>
    // JavaScript
    function useDefaultAddress() {
      
        document.getElementById('collapseExample1').style.display = 'none';
        document.getElementById('collapseExample2').style.display = 'block';
    }

    function createNewAddress() {
        document.getElementById('collapseExample1').style.display = 'block';    
        document.getElementById('collapseExample2').style.display = 'none';
    }   
</script>
