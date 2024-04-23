<?php
if (isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $matkhau = md5($_POST['matkhau']);
    $diachi = $_POST['diachi'];
    $sql_dangky = "INSERT INTO tbl_customer(username,email,customer_address,customer_password,phonenumber) VALUE('".$tenkhachhang."','".$email."','".$diachi."','".$matkhau."','".$dienthoai."')";
    $query_dangky = mysqli_query($mysqli,$sql_dangky);
    if($query_dangky)
    {
        echo '<p style="color:green">Register Successfully !</p>';
        $_SESSION['dangky'] = $tenkhachhang;
?>
        <script>
            window.location.href='index.php?manage=carts';    // không cần dùng đến header:'Location:../../index.php?manage=carts' vì có thể bị lỗi
        </script>
<?php       
    }
}
?>

<p style="font-size: 50px; text-align:center;">Register</p>

<form action="" method="POST">

    <div class="form-group" >
        <label for="exampleInputPassword1">Username</label>
        <input type="text" name="hovaten" class="form-control" id="exampleInputPassword1" placeholder="Username">
    </div>

    <div class="form-group" style="margin-top: 25px;">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group" style="margin-top: 25px;">
        <label for="exampleInputPassword1">Phone number</label>
        <input type="text" name="dienthoai" class="form-control" id="exampleInputPassword1" placeholder="Phone number">
    </div>

    <div class="form-group" style="margin-top: 25px;">
        <label for="exampleInputPassword1">Address</label>
        <input type="text" name="diachi" class="form-control" id="exampleInputPassword1" placeholder="Address">
    </div>

    <div class="form-group" style="margin-top: 25px;">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="matkhau" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>

    <button style="margin-top: 25px;" name="dangky" type="submit" class="btn btn-primary">Register</button>
    <div style="margin-top:25px; ">
    <a href="index.php?manage=login" > Have you already had the account ?</a>
    </div>
</form>