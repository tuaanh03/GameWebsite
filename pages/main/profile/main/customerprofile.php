<?php
$id_dangky = $_SESSION['id_khachhang'];
$sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_customer WHERE customer_id = '$id_dangky' LIMIT 1");
$count = mysqli_num_rows($sql_get_vanchuyen);
if ($count > 0) {
    $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
    $name = $row_get_vanchuyen['username'];
    $phone = $row_get_vanchuyen['phonenumber'];
    $email = $row_get_vanchuyen['email'];
} else {
    $name = '';
    $phone = '';
    $email = '';
}
?>


<div class="row">
    <div class="col-md-12">
        <h2>Your Profile</h2>
        <div class="col-md-4">
            <h4>Username </h4><?php echo $name ?>
        </div>

        <h4>Email </h4><?php echo $email ?>


        <hr>
    </div>

</div>
<div class="row">

    <div class="col-md-12">
        <form>
            <div class="form-group row">
                <label for="name" class="col-4 col-form-label">First Name</label>
                <div class="col-8">
                    <input id="name" name="name" placeholder="First Name" class="form-control here" type="text">
                </div>
            </div>

            <div class="form-group row">
                <label for="lastname" class="col-4 col-form-label">Last Name</label>
                <div class="col-8">
                    <input id="lastname" name="lastname" placeholder="Last Name" class="form-control here" type="text">
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
                    <select id="select" name="select" class="custom-select">
                        <option value="" disabled selected>Select Province / City</option>
                        <option value="admin">Ho Chi Minh City</option>
                    </select>

                </div>
            </div>
            <div class="form-group row">
                <label for="province" class="col-4 col-form-label">District</label>
                <div class="col-8">
                    <select id="select" name="select" class="custom-select">
                        <option value="" disabled selected>Select district</option>
                        <option value="admin">Ho Chi Minh City</option>
                    </select>

                </div>
            </div>

            <div class="form-group row">
                <label for="province" class="col-4 col-form-label">Ward</label>
                <div class="col-8">
                    <select id="select" name="select" class="custom-select">
                        <option value="" disabled selected>Select ward</option>
                        <option value="admin">Ho Chi Minh City</option>
                    </select>

                </div>
            </div>

            <div class="form-group row">
                <label for="publicinfo" class="col-4 col-form-label">Public Info</label>
                <div class="col-8">
                    <input id="lastname" name="lastname" placeholder="Street Address" class="form-control here" type="text">
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
                </div>
            </div>
        </form>
    </div>
</div>