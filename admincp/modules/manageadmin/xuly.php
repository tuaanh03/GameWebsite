<?php
    include('../../config/config.php');
    if(isset($_GET['user_status']) && isset($_GET['id']))
    {
        $status = $_GET['user_status'];
        $code = $_GET['id'];
        $sql = "UPDATE tbl_admin SET admin_status = '".$status."' WHERE id_admin ='".$code."'";
        $query = mysqli_query($mysqli,$sql);
        header('Location:../../index.php?action=manageadmin&query=list');
    }

?>