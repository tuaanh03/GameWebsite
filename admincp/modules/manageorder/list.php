<div class="row">
    <div class="col-md-5">
        <p>Manage orders</p>
    </div>
    <div class="col-md-7">

    </div>
</div>


<table class="table">
    <form action="" method="GET" id="orderForm">
        <input type="hidden" name="action" value="manageorders">
        <input type="hidden" name="query" value="list">
        <div class="row">
            <div class="col-md-4">
                <label for="" style="margin-left: 40px;">Date from</label>
                <input type="date" name="datefrom" value="<?= isset($_GET['date']) == true ? $_GET['date'] : '' ?>" class="form-control" style="margin-left: 35px;">
            </div>

            <div class="col-md-4">
                <label for="" style="margin-left: 40px;">Date to</label>
                <input type="date" name="dateto" value="<?= isset($_GET['date']) == true ? $_GET['date'] : '' ?>" class="form-control" style="margin-left: 35px;">
            </div>

            <div class="form-group" style="margin-top: 80px;">
                <label for="exampleInputPassword1" style="margin-left: 50px;">Province</label>
                <select name="province" id="province" class="form-control" style="width: 32%; margin-left:50px;">
                    <option value="" disabled selected>Select Province / City</option>

                </select>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                <label for="exampleInputPassword1" style="margin-left: 50px;">District</label>
                <select name="district" id="district" class="form-control" style="width: 32%; margin-left:50px;">
                    <option value="" disabled selected>Select district</option>
                </select>
            </div>



            <div class="col-md-4" style="width: 20%;">
                <select name="status" class="form-select" style="margin-left: 35px;">
                    <option value="" <?= isset($_GET['status']) == true ? ($_GET['status'] == '' ? 'selected' : '') : '' ?>>None</option>
                    <option value="0" <?= isset($_GET['status']) == true ? ($_GET['status'] == '0' ? 'selected' : '') : '' ?>>Approve</option>
                    <option value="1" <?= isset($_GET['status']) == true ? ($_GET['status'] == '1' ? 'selected' : '') : '' ?>>Pending</option>
                    <option value="2" <?= isset($_GET['status']) == true ? ($_GET['status'] == '2' ? 'selected' : '') : '' ?>>Complete</option>
                    <option value="-1" <?= isset($_GET['status']) == true ? ($_GET['status'] == '-1' ? 'selected' : '') : '' ?>>Cancelled</option>
                </select>
            </div>

            <div class="col-md-4" style="padding: 0; margin:20px 0px 20px 0px; ">
                <button name="submit" type="submit" class="btn btn-primary">Filter</button>
                <a href="#" id="resetButton" class="btn btn-danger" onclick="myFunction()">Reset</a>
            </div>
        </div>
    </form>
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">ID of order</th>
            <th scope="row">ID of user</th>
            <th scope="row">Customer name</th>
            <th scope="row">Address</th>
            <th scope="row">Phone number</th>
            <th scope="row">Cart Payment</th>
            <th scope="row">Status</th>
            <th scope="row">Date order</th>
            <th scope="row">Manage</th>
        </tr>

        <?php
        $sql_lietke_dh = "SELECT * FROM orders,tbl_shipping WHERE orders.users_id = tbl_shipping.customer_id AND orders.cart_shipping = tbl_shipping.id_shipping";
        if ((isset($_GET['datefrom']) && $_GET['datefrom'] != '' && isset($_GET['datefrom']) && $_GET['datefrom'] != '')) {
            $datefrom = $_GET['datefrom'];
            $dateto = $_GET['dateto'];
            if ($_GET['datefrom'] === $_GET['dateto']) {
                $sql_lietke_dh .= " AND orders.order_date LIKE '%" . $datefrom . "%'   ";

            } else {
                
                $sql_lietke_dh .= " AND orders.order_date BETWEEN '" . $datefrom . "' AND '" . $dateto . "'";
            }
        }
        if (isset($_GET['status']) && $_GET['status'] != '') {
            $status = $_GET['status'];
            $sql_lietke_dh .= " AND orders.status_order = " . $status;
        }
        if (isset($_GET['province']) && $_GET['province'] != '') {
            $province = $_GET['province'];
            $sql_lietke_dh .= " AND tbl_shipping.province = '".$province."'";
        }

        if (isset($_GET['district']) && $_GET['district'] != '') {
            $district = $_GET['district'];
            $sql_lietke_dh .= " AND tbl_shipping.district = '".$district."'";
        }


        $sql_lietke_dh .= " ORDER BY orders.orders_id DESC";

        $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_dh)) {
            $i++;
        ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['code_orders'] ?></td>
                <td><?php echo $row['users_id'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['address'] ?>, <?php echo $row['ward'] ?>, <?php echo $row['district'] ?>, <?php echo $row['province'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td><?php echo $row['cart_payment'] ?></td>
                <td>
                    <a href="modules/manageorder/xuly.php?cart_status=<?php echo $row['status_order'] ?>&coder=<?php echo $row['code_orders'] ?>" <?php if ($row['status_order'] == 1) {  ?> style="color: rgb(254,192,94);" <?php } elseif ($row['status_order'] == 2) { ?>style="color: rgb(114,185,104);" <?php } elseif ($row['status_order'] == -1) { ?>style="color: rgb(217,83,79);" <?php } ?>>
                        <?php
                        if ($row['status_order'] == 1) {
                            echo 'Pending';
                        } elseif ($row['status_order'] == 0) {
                            echo 'Approve';
                        } elseif ($row['status_order'] == 2) {
                            echo 'Completed';
                        } elseif ($row['status_order'] == -1) {
                            echo 'Cancelled';
                        }
                        ?>
                    </a>

                </td>
                <td><?php echo $row['order_date'] ?></td>
                <td>
                    <a href="index.php?action=manageorders&query=vieworder&coder=<?php echo $row['code_orders'] ?>">View order details</a>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const citySelect = document.getElementById('province');
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');
        const dateFromInput = document.querySelector('input[name="datefrom"]');
        const dateToInput = document.querySelector('input[name="dateto"]');

        let selectedCity = '';
        let selectedDistrict = '';
        let selectedDateFrom = '';
        let selectedDateTo = '';
        // Định nghĩa danh sách các thành phố và các quận theo thành phố
        const cities = {
            "Ho Chi Minh City": ["District 1", "District 2", "District 3", "District 4", "District 5", "District 6", "District 7", "District 8", "District 9", "District 10", "District 11", "District 12", "Go Vap", "Binh Tan", "Can Gio", "Binh Chanh", "Binh Thanh"],
            "Da Nang": ['Son Tra', 'Cam Le'],
            "Ha Noi": ["Ba Dinh", "Hoan Kiem", "Long Bien", "Tay Ho", ]
        };

        // Định nghĩa danh sách các phường theo quận
        // const wardsByDistrict = {
        //     "District 1": ["Tan Dinh Ward", "Da Kao Ward", "Ben Nghe Ward", "Ben Thanh Ward", "Nguyen Thai Binh Ward"],
        //     "District 2": ["Thao Dien Ward", "An Phu Ward", "Binh An Ward", "Binh Trung Dong Ward", "Binh Trung Tay Ward"],
        //     "District 3": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "District 4": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "District 5": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "District 6": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "District 7": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "District 8": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "District 9": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "District 10": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     // Thêm thông tin cho các quận còn lại
        //     "District 11": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "District 12": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "Binh Tan": ["Phường Bình Trị Đông", "Phường Bình Trị Đông A", "Phường Bình Hưng Hòa", "Phường Bình Hưng Hoà A", "Phường Bình Hưng Hoà B"],
        //     "Binh Thanh": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "Go Vap": ["Ward 1", "Ward 2", "Ward 3", "Ward 4", "Ward 5"],
        //     "Binh Chanh": ["Commune 1, Binh Chanh", "Commune 2, Binh Chanh", "Commune 3, Binh Chanh", "Commune 4, Binh Chanh", "Commune 5, Binh Chanh"],
        //     "Can Gio": ["Commune 1, Can Gio", "Commune 2, Can Gio", "Commune 3, Can Gio", "Commune 4, Can Gio", "Commune 5, Can Gio"],
        //     "Ba Dinh": ["Truc Bach Ward", "Vinh Phuc Ward", "Cong Vi Ward", "Lieu Giai Ward", "Nguyen Trung Truc Ward"],
        //     "Hoan Kiem": ["Phuc Tan Ward", "Dong Xuan Ward", "Hang Gai Ward", "Hang Bac Ward", "Hang Bo Ward"],
        //     "Tay Ho": ["Quang An Ward", "Xuan La Ward", "Yen Phu Ward", "Thuy Khue Ward", "Tay Ho Ward"],
        //     "Long Bien": ["Thuong Thanh Ward", "Ngoc Thuy Ward", "Bo De Ward", "Sai Dong Ward", "Gia Thuy Ward"],

        //     "Son Tra": ["Phuoc My Ward", "Tho Quang Ward"],
        //     "Cam Le": ["Hoa An Ward", "Hoa Xuan Ward"]
        // };

        // Tạo các option cho dropdown thành phố
        Object.keys(cities).forEach(function(city) {
            const optionElem = document.createElement('option');
            optionElem.textContent = city;
            optionElem.value = city;
            citySelect.appendChild(optionElem);
        });

        // GIữ các option mặc định cho dropdown quận/huyện và phường/xã
        districtSelect.innerHTML = '<option value="">Select District</option>';
        // wardSelect.innerHTML = '<option value="">Chọn phường/xã</option>';

        // Xử lý sự kiện khi chọn thành phố
        citySelect.addEventListener('change', function() {
            selectedCity = this.value;
            const districts = cities[selectedCity];
            populateDropdown(districtSelect, districts);
            clearDropdown(wardSelect);
        });

        // Xử lý sự kiện khi chọn quận
        districtSelect.addEventListener('change', function() {
            selectedDistrict = this.value;
            if (selectedDistrict) {
                const wards = wardsByDistrict[selectedDistrict];
                populateDropdown(wardSelect, wards);
            } else {
                clearDropdown(wardSelect);
            }
        });

        const form = document.getElementById("orderForm");
        form.addEventListener("submit", function(event) {
            selectedCity = citySelect.value;
            selectedDistrict = districtSelect.value;
            selectedDateFrom = dateFromInput.value;
            selectedDateTo = dateToInput.value;
            sessionStorage.setItem('selectedCity', selectedCity); // Lưu giá trị vào sessionStorage
            sessionStorage.setItem('selectedDistrict', selectedDistrict); // Lưu giá trị vào sessionStorage
            sessionStorage.setItem('selectedDateFrom', selectedDateFrom);
            sessionStorage.setItem('selectedDateTo', selectedDateTo);
        });

        // Thiết lập giá trị cho dropdown "Province" sau khi form được gửi đi
        const storedCity = sessionStorage.getItem('selectedCity');
        if (storedCity) {
            citySelect.value = storedCity;
            selectedCity = storedCity;
            const districts = cities[selectedCity];
            populateDropdown(districtSelect, districts);
        }

        const storedDistrict = sessionStorage.getItem('selectedDistrict');
        if (storedDistrict) {
            districtSelect.value = storedDistrict;
            selectedDistrict = storedDistrict;

        }
        const storedDateFrom = sessionStorage.getItem('selectedDateFrom');
        if (storedDateFrom) {
            dateFromInput.value = storedDateFrom;
            selectedDateFrom = storedDateFrom;
        }

        const storedDateTo = sessionStorage.getItem('selectedDateTo');
        if (storedDateTo) {
            dateToInput.value = storedDateTo;
            selectedDateTo = storedDateTo;
        }



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
    function myFunction() {
        document.getElementById("orderForm").reset();
        document.querySelector('input[type="date"]').value = '';
        document.querySelector('select[name="status"]').value = '';
    }
</script>