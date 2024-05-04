<?php
//kiểm tra form đc submit và lưu dữ liệu
if (isset($_POST['updateprofile'])) {
    $_SESSION['form_data'] = $_POST;
    // Redirect đến trang hiện tại để tránh gửi lại dữ liệu khi người dùng refresh trang
    echo "<script>window.location.href = '{$_SERVER['REQUEST_URI']}';</script>";
    exit;
}

//check
//nếu như có nhận update thì thực hiện if này
if (isset($_SESSION['form_data'])) {
    $id_dangky = $_SESSION['id_khachhang'];
    $form_data = $_SESSION['form_data'];
    // Lấy dữ liệu từ session
    $name = isset($form_data['name']) ? $form_data['name'] : '';
    $email = isset($form_data['email']) ? $form_data['email'] : '';
    $phone = isset($form_data['phonenumber']) ? $form_data['phonenumber'] : '';
    $province = isset($form_data['province']) ? $form_data['province'] : '';
    $district = isset($form_data['district']) ? $form_data['district'] : '';
    $ward = isset($form_data['ward']) ? $form_data['ward'] : '';
    $streetaddress = isset($form_data['streetaddress']) ? $form_data['streetaddress'] : '';
    $sql_update = "UPDATE tbl_customer SET customer_province = '" . $province . "',customer_district='" . $district . "',customer_ward='" . $ward . "',customer_address='" . $streetaddress . "',phonenumber='" . $phone . "' WHERE customer_id = '" . $id_dangky . "'";
    mysqli_query($mysqli, $sql_update);
    unset($_SESSION['form_data']); // Xóa dữ liệu trong session sau khi đã sử dụng
}
// nếu không sẽ thực hiện phần này
else {
    // Nếu không có dữ liệu trong session, sử dụng dữ liệu từ cơ sở dữ liệu
    $id_dangky = $_SESSION['id_khachhang'];
    $sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_customer WHERE customer_id = '$id_dangky' LIMIT 1");
    $count = mysqli_num_rows($sql_get_vanchuyen);
    if ($count > 0) {
        $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
        $name = $row_get_vanchuyen['username'];
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
}





// choose address


if (isset($_POST['updateprofile'])) {
}

?>



<div class="row">
    <div class="col-md-12">
        <h2>Your Profile</h2>


        <hr>
    </div>

</div>
<div class="row">

    <div class="col-md-12">
        <form method="POST">
            <div class="form-group row">
                <label for="name" class="col-4 col-form-label">Username</label>
                <div class="col-8">
                    <input value="<?php echo $name?>" readonly id="name" name="name" placeholder="Username" class="form-control here" type="text">
                </div>
            </div>

            <div class="form-group row">
            <label for="name" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input value="<?php echo $email?>" readonly id="lastname" name="email" placeholder="Email" class="form-control here" type="text">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-4 col-form-label">Full Name</label>
                <div class="col-8">
                    <input id="lastname" name="fullname" placeholder="Last Name" class="form-control here" type="text">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-4 col-form-label">Phone Number</label>
                <div class="col-8">
                    <input value="<?php echo $phone ?>" id="name" name="phonenumber" placeholder="Phone Number" class="form-control here" type="text">
                </div>
            </div>

            <div class="form-group row">
                <label for="province" class="col-4 col-form-label">Province / City</label>
                <div class="col-8">
                    <select id="province" name="province" class="custom-select">
                        <option value="" disabled selected>Select Province / City</option>
                        <!-- Added options for cities -->
                        <option value="TP Hồ Chí Minh">TP Hồ Chí Minh</option>
                        <option value="Hà Nội">Hà Nội</option>
                        <!-- Add other cities here if needed -->
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="district" class="col-4 col-form-label">District</label>
                <div class="col-8">
                    <select id="district" name="district" class="custom-select">
                        <option value="" disabled selected>Select district</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="ward" class="col-4 col-form-label">Ward</label>
                <div class="col-8">
                    <select id="ward" name="ward" class="custom-select">
                        <option value="" disabled selected>Select ward</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="publicinfo" class="col-4 col-form-label">Street</label>
                <div class="col-8">
                    <input value="<?php echo $streetaddress ?>" id="lastname" name="streetaddress" placeholder="Street Address" class="form-control here" type="text">
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="updateprofile" type="submit" class="btn btn-primary">Update My Profile</button>
                </div>
            </div>
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'successfully') {
                echo '<p style="color:green;">Successfully to add product.</p>';
            }
            ?>
        </form>
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






    // Đặt giá trị của tỉnh/thành phố
    document.getElementById("province").value = "<?php echo $province; ?>";

    // Kích hoạt sự kiện change để cập nhật các quận huyện tương ứng
    var event = new Event('change');
    document.getElementById("province").dispatchEvent(event);

    // Đặt giá trị của quận/huyện
    document.getElementById("district").value = "<?php echo $district; ?>";

    // Kích hoạt sự kiện change để cập nhật các phường/xã tương ứng
    document.getElementById("district").dispatchEvent(event);

    // Đặt giá trị của phường/xã
    document.getElementById("ward").value = "<?php echo $ward; ?>";

    

    // Hàm trả về danh sách các phường, xã của một quận cụ thể
    function getWards(district) {
        return wards[district] || []; // Trả về mảng các phường, xã của quận hoặc một mảng trống nếu không tìm thấy
    }
</script>