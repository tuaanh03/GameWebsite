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
    $fullname = isset($form_data['fullname']) ? $form_data['fullname'] : '';
    $email = isset($form_data['email']) ? $form_data['email'] : '';
    $phone = isset($form_data['phonenumber']) ? $form_data['phonenumber'] : '';
    $province = isset($form_data['province']) ? $form_data['province'] : '';
    $district = isset($form_data['district']) ? $form_data['district'] : '';
    $ward = isset($form_data['ward']) ? $form_data['ward'] : '';
    $streetaddress = isset($form_data['streetaddress']) ? $form_data['streetaddress'] : '';
    $sql_update = "UPDATE tbl_customer SET fullname = '" . $fullname . "', customer_province = '" . $province . "',customer_district='" . $district . "',customer_ward='" . $ward . "',customer_address='" . $streetaddress . "',phonenumber='" . $phone . "' WHERE customer_id = '" . $id_dangky . "'";
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
        $fullname = $row_get_vanchuyen['fullname'];
        $phone = $row_get_vanchuyen['phonenumber'];
        $email = $row_get_vanchuyen['email'];
        $province = $row_get_vanchuyen['customer_province'];
        $district = $row_get_vanchuyen['customer_district'];
        $ward = $row_get_vanchuyen['customer_ward'];
        $streetaddress = $row_get_vanchuyen['customer_address'];
    } else {
        $name = '';
        $fullname = '';
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
                    <input value="<?php echo $name ?>" readonly id="name" name="name" placeholder="Username" class="form-control here" type="text">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input value="<?php echo $email ?>" readonly id="lastname" name="email" placeholder="Email" class="form-control here" type="text">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-4 col-form-label">Full Name</label>
                <div class="col-8">
                    <input value="<?php echo $fullname ?>" id="lastname" name="fullname" placeholder="Full Name" class="form-control here" type="text">
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
                    <select id="province" name="province" class="form-control here">
                        <option value="" disabled selected>Select Province / City</option>
                        <!-- Added options for cities -->
                        <option value="Ho Chi Minh City">Ho Chi Minh City</option>
                        <option value="Ha Noi">Ha Noi</option>
                        <option value="Da Nang">Da Nang</option>
                        <!-- Add other cities here if needed -->
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="district" class="col-4 col-form-label">District</label>
                <div class="col-8">
                    <select id="district" name="district" class="form-control here">
                        <option value="" disabled selected>Select district</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="ward" class="col-4 col-form-label">Ward</label>
                <div class="col-8">
                    <select id="ward" name="ward" class="form-control here">
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
                    <button name="updateprofile" type="submit" class="btn btn-primary" onclick="return validateForm();">Update My Profile</button>
                </div>
            </div>
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'successfully') {
                echo '<p style="color:green;">Successfully to updata product.</p>';
            }
            ?>
        </form>
    </div>
</div>


<script>
    var cities = {
        "Ho Chi Minh City": ["District 1", "District 2", "District 3", "District 4", "District 5", "District 6", "District 7", "District 8", "District 9", "District 10", "District 11", "District 12", "Go Vap", "Binh Tan", "Can Gio", "Binh Chanh", "Binh Thanh"],
        "Da Nang": ['Son Tra', 'Cam Le'],
        "Ha Noi": ["Ba Dinh", "Hoan Kiem", "Long Bien", "Tay Ho", ]
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


<script>
    function validateForm() {
        // Regular expression for phone number
        var phoneRegex = /^\d{10,11}$/; // Change the regex according to your requirements  
        var phone = document.querySelector("input[name='phonenumber']").value;
        

        // Check if any field is empty or phone number is invalid
        if (!phoneRegex.test(phone)) {
            // Show error message
            alert("Vui lòng kiểm tra lại thông tin.");
            return false; // Prevent form submission
        }
    }
</script>