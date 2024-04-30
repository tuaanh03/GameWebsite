<?php
    include('../../config/config.php');
    if(isset($_GET['user_status']) && isset($_GET['id']))
    {
        $status = $_GET['user_status'];
        $code = $_GET['id'];
        $sql = "UPDATE tbl_customer SET status_user='".$status."' WHERE customer_id ='".$code."'";
        $query = mysqli_query($mysqli,$sql);
        header('Location:../../index.php?action=manageusers&query=list');
    }

?>