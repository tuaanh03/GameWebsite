<?php
    use Carbon\Carbon;
    include('../config/config.php');
    require('../../carbon/autoload.php');
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $sql = "SELECT * FROM tbl_statiscal WHERE '$subdays' AND '$now' ORDER BY dateorder ASC ";
    $sql_query = mysqli_query($mysqli,$sql);

    while($val  = mysqli_fetch_array($sql_query))
    {

        $chart_data[] = array(
            'date' => $val['dateorder'],
            'order' => $val['statiscal_order'],
            'sales' => $val['profit'],
            'quantity' => $val['statiscal_quantity']
        );
    }
    echo $data = json_encode($chart_data);
?>