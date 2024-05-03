<p style="font-size: 50px; text-align:center;">Register</p>
<?php


$form_submitted = false;

$tenkhachhang = '';
$email = '';
$dienthoai = '';
$diachi = '';

// Kiểm tra khi form được submit
if (isset($_POST['dangky'])) {
    $form_submitted = true; // Đánh dấu rằng form đã được gửi đi

    // Lấy dữ liệu từ form
    $tenkhachhang = mysqli_real_escape_string($mysqli, $_POST['hovaten']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $dienthoai = mysqli_real_escape_string($mysqli, $_POST['dienthoai']);
    $matkhau = md5($_POST['matkhau']);
    $xacnhanmatkhau = md5($_POST['xacnhanmatkhau']);
    

    // Kiểm tra và hiển thị thông báo nếu các trường nhập liệu bị thiếu
    if (empty($tenkhachhang) || empty($email) || empty($dienthoai) || empty($_POST['matkhau'])) {
        echo '<p style="color:red">Please fill in all fields!</p>';
    } else {
        // Kiểm tra email đã tồn tại trong database chưa
        $sql_check_email = "SELECT * FROM tbl_customer WHERE email='" . $email . "'";
        $query_check_email = mysqli_query($mysqli, $sql_check_email);
        if (mysqli_num_rows($query_check_email) > 0) {
            echo '<p style="color:red">Email has already been registered!</p>';
        } else {
            // Kiểm tra username đã tồn tại trong database chưa
            $sql_check_username = "SELECT * FROM tbl_customer WHERE username='" . $tenkhachhang . "'";
            $query_check_username = mysqli_query($mysqli, $sql_check_username);
            if (mysqli_num_rows($query_check_username) > 0) {
                echo '<p style="color:red">Username has already been taken!</p>';
            } else {
                if (!preg_match("/^\d{10,11}$/", $dienthoai)) {
                    echo '<p style="color:red">Please enter a valid phone number!</p>';
                } else {
                    if ($matkhau === $xacnhanmatkhau) {
                        // Thực hiện thêm thông tin vào database
                        $sql_dangky = "INSERT INTO tbl_customer(username,email,customer_password,phonenumber) VALUE('" . $tenkhachhang . "','" . $email . "','" . $matkhau . "','" . $dienthoai . "')";
                        $query_dangky = mysqli_query($mysqli, $sql_dangky);
                        if ($query_dangky) {
                            echo '<p style="color:green">Register Successfully !</p>';
                            $_SESSION['dangky'] = $tenkhachhang;
                            $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);
                            $_SESSION['diachi'] = $diachi;
                            // Chuyển hướng sau khi đăng ký thành công
                            echo '<script>window.location.href="index.php?manage=carts";</script>';
                        } else {
                            echo '<p style="color:red">Registration failed!</p>';
                        }
                    }
                    else
                    {
                        echo '<p style="color:red">Please enter a valid confirm password!</p>';
                    }
                }
            }
        }
    }
}
?>



<form action="" method="POST">

    <div class="form-group">
        <label for="exampleInputPassword1">Username</label>
        <input type="text" name="hovaten" class="form-control" id="exampleInputPassword1" placeholder="Username" value="<?php echo htmlspecialchars($tenkhachhang); ?>">
        <?php if ($form_submitted && empty($tenkhachhang)) {
            echo '<p style="color:red">Please enter your username!</p>';
        } ?>
    </div>

    <div class="form-group" style="margin-top: 25px;">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo htmlspecialchars($email); ?>">
        <?php if ($form_submitted && empty($email)) {
            echo '<p style="color:red">Please enter your email!</p>';
        } ?>
    </div>

    <div class="form-group" style="margin-top: 25px;">
        <label for="exampleInputPassword1">Phone number</label>
        <input type="text" name="dienthoai" class="form-control" id="exampleInputPassword1" placeholder="Phone number" value="<?php echo htmlspecialchars($dienthoai); ?>">
        <?php if ($form_submitted && empty($dienthoai)) {
            echo '<p style="color:red">Please enter your phone number!</p>';
        } ?>
    </div>

   
    <div class="form-group" style="margin-top: 25px;">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="matkhau" class="form-control" id="exampleInputPassword1" placeholder="Password">
        <?php if ($form_submitted && empty($_POST['matkhau'])) {
            echo '<p style="color:red">Please enter your password!</p>';
        } ?>
    </div>

    <div class="form-group" style="margin-top: 25px;">
        <label for="exampleInputPassword1">Confirm Password</label>
        <input type="password" name="xacnhanmatkhau" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
        <?php if ($form_submitted && empty($_POST['xacnhanmatkhau'])) {
            echo '<p style="color:red">Please enter your confirm password!</p>';
        } ?>
    </div>

    <button style="margin-top: 25px;" name="dangky" type="submit" class="btn btn-primary">Register</button>
    <div style="margin-top:25px; ">
        <a href="index.php?manage=login"> Have you already had the account ?</a>
    </div>
</form>