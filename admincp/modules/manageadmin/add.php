
<?php


$form_submitted = false;

$tenadmin = '';


// Kiểm tra khi form được submit
if (isset($_POST['dangky'])) {
    $form_submitted = true; // Đánh dấu rằng form đã được gửi đi

    // Lấy dữ liệu từ form
    $tenadmin = mysqli_real_escape_string($mysqli, $_POST['hovaten']);
    $matkhau = md5($_POST['matkhau']);
    $xacnhanmatkhau = md5($_POST['xacnhanmatkhau']);
    

    // Kiểm tra và hiển thị thông báo nếu các trường nhập liệu bị thiếu
    if (empty($tenadmin) || empty($_POST['matkhau'])) {
        echo '<p style="color:red">Please fill in all fields!</p>';
    } else {
            // Kiểm tra username đã tồn tại trong database chưa
            $sql_check_username = "SELECT * FROM tbl_customer WHERE username='" . $tenadmin . "'";
            $query_check_username = mysqli_query($mysqli, $sql_check_username);
            if (mysqli_num_rows($query_check_username) > 0) {
                echo '<p style="color:red">Username has already been taken!</p>';
            } else {
                    if ($matkhau === $xacnhanmatkhau) {
                        // Thực hiện thêm thông tin vào database
                        $sql_dangky = "INSERT INTO tbl_admin(username,password,admin_status) VALUE('" . $tenadmin . "','" . $matkhau . "', 0)";
                        $query_dangky = mysqli_query($mysqli, $sql_dangky);
                        if ($query_dangky) {
                            echo '<p style="color:green">Register Successfully !</p>';
                            
                            // Chuyển hướng sau khi đăng ký thành công
                            echo '<script>window.location.href="index.php?action=manageadmin&query=list";</script>';
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
?>



<form action="" method="POST">

    <div class="form-group">
        <label for="exampleInputPassword1">Username</label>
        <input type="text" name="hovaten" class="form-control" id="exampleInputPassword1" placeholder="Username" value="<?php echo htmlspecialchars($tenadmin); ?>">
        <?php if ($form_submitted && empty($tenadmin)) {
            echo '<p style="color:red">Please enter your username!</p>';
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

    <button style="margin: 10px;" name="dangky" type="submit" class="btn btn-primary">Add user account</button>
    
</form>