<?php

if (isset($_POST['dangnhap'])) {
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $matkhau = md5($_POST['password']);
    $sql = "SELECT * FROM tbl_customer WHERE email = '" . $email . "' AND customer_password = '" . $matkhau . "' LIMIT 1 ";
    $row = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($row);
    if ($count > 0) {
        $row_data = mysqli_fetch_array($row);
        if ($row_data['status_user'] == 1) {
            echo '<p>Your account is blocked.</p>';
        } 
        else {
            $_SESSION['dangky'] = $row_data['username'];
            $_SESSION['id_khachhang'] = $row_data['customer_id'];
            $_SESSION['diachi'] = $row_data['customer_address'];
?>

            <script>
                window.location.href = 'index.php?manage=carts'; // không cần dùng đến header:'Location:../../index.php?manage=carts' vì có thể bị lỗi
            </script>
        <?php
        }
        ?>

<?php

    } else {
        echo '<p>Sai</p>';
    }
}

?>



<p style="font-size: 50px; text-align:center;">Login</p>
<form action="" method="POST">

    <div class="form-group" style="margin-top: 25px;">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group" style="margin-top: 25px;">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>

    <button style="margin-top: 25px;" name="dangnhap" type="submit" class="btn btn-primary">Login</button>
    <div style="margin-top:25px; ">
        <a href=""> Have you already had the account ?</a>
    </div>
</form>