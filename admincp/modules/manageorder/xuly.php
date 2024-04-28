
<?php
    include('../../config/config.php');
    if(isset($_GET['cart_status']) && isset($_GET['coder']))
    {
        $status = $_GET['cart_status'];
        $code = $_GET['coder'];
        $sql = "UPDATE orders SET status_order='".$status."' WHERE code_orders='".$code."'";
        $query = mysqli_query($mysqli,$sql);
        header('Location:../../index.php?action=manageorders&query=list');
    }
?>