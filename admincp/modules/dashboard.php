<p>List user</p>
<style>
    .inner-table th,
    .inner-table td {
        padding: 30px;
        /* Điều chỉnh giá trị padding tùy thích */
    }
</style>
<table class="table">
    <form action="" method="GET" id="orderForm">

        <div class="row">
            <div class="col-md-4">
                <label for="" style="margin-left: 40px;">Date from</label>
                <input type="date" name="datefrom" value="<?= isset($_GET['date']) == true ? $_GET['date'] : '' ?>" class="form-control" style="margin-left: 35px;">
            </div>

            <div class="col-md-4">
                <label for="" style="margin-left: 40px;">Date to</label>
                <input type="date" name="dateto" value="<?= isset($_GET['date']) == true ? $_GET['date'] : '' ?>" class="form-control" style="margin-left: 35px;">
            </div>
            <div class="col-md-4" style="margin-left:100px; padding:50px">
                <button name="submit" type="submit" class="btn btn-primary">Filter</button>
                <a href="#" id="resetButton" class="btn btn-danger" onclick="myFunction()">Reset</a>
            </div>
    </form>
    <?php
    $sql_lietke_thongke = "SELECT cus.*,ord.*, SUM(ord.total_money) AS total_purchase
    FROM orders ord
    JOIN tbl_customer cus ON ord.users_id = cus.customer_id ";
    if ((isset($_GET['datefrom']) && $_GET['datefrom'] != '' && isset($_GET['datefrom']) && $_GET['datefrom'] != '')) {
        $datefrom = $_GET['datefrom'];
        $dateto = $_GET['dateto'];
        if ($_GET['datefrom'] === $_GET['dateto']) {
            $sql_lietke_thongke .= " WHERE ord.order_date LIKE '%" . $datefrom . "%'   ";
        } else {

            $sql_lietke_thongke .= " WHERE ord.order_date BETWEEN '" . $datefrom . "' AND '" . $dateto . "' OR ord.order_date LIKE '" . $datefrom . "' ";
        }
    }
    $sql_lietke_thongke .= " GROUP BY ord.users_id
    ORDER BY total_purchase DESC
    LIMIT 5 ";
    $query_lietke_thongke = mysqli_query($mysqli, $sql_lietke_thongke);
    ?>
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <th scope="row">Customer username</th>
            <th scope="row">Total money</th>
            <th scope="row">Show all orders</th>

        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_thongke)) {
            $i++;
        ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo number_format($row['total_purchase']) . 'đ' ?></td>
                <td><button id="toggleButton<?php echo $i ?>" class="btn btn-primary" onclick="toggleText('<?php echo $i ?>')">Show Text</button>
                    <div id="hiddenText<?php echo $i ?>" style="display: none;">
                        <table class="inner-table">
                            <thead>
                                <tr>
                                    <th scope="col">Date order</th>
                                    <th scope="col">ID of order</th>
                                    <th scope="col">Total money</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Manage</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $id_user = $row['users_id'];
                                $sql_lietke = "SELECT ord.* FROM orders ord WHERE ord.users_id = '" . $id_user . "'";
                                if ((isset($_GET['datefrom']) && $_GET['datefrom'] != '' && isset($_GET['datefrom']) && $_GET['datefrom'] != '')) {
                                    $datefromlietke = $_GET['datefrom'];
                                    $datetolietke = $_GET['dateto'];
                                    if ($_GET['datefrom'] === $_GET['dateto']) {
                                        $sql_lietke .= " AND ord.order_date LIKE '%" . $datefromlietke . "%'   ";
                                    } else {

                                        $sql_lietke .= " AND ord.order_date BETWEEN '" . $datefromlietke . "' AND '" . $datetolietke . "' OR ord.order_date LIKE '" . $datefromlietke . "' ";
                                    }
                                }
                                $sql_lietke .= " ORDER BY ord.total_money DESC";

                                $query_lietke = mysqli_query($mysqli, $sql_lietke);
                                while ($order_row = mysqli_fetch_array($query_lietke)) {
                                ?>
                                    <tr>
                                        <td><?php echo $order_row['order_date'] ?></td>
                                        <td><?php echo $order_row['code_orders'] ?></td>
                                        
                                        <td><?php echo number_format($order_row['total_money']) . 'đ' ?></td>

                                        <td>
                                            <h4 <?php if ($order_row['status_order'] == 1) {  ?> style="color: rgb(254,192,94);" <?php } elseif ($order_row['status_order'] == 2) { ?>style="color: rgb(114,185,104);" <?php } elseif ($order_row['status_order'] == -1) { ?> style="color: rgb(220,53,69);" <?php } elseif ($order_row['status_order'] == 0) { ?> style="color: rgb(42,152,214);" <?php } ?>>
                                                <?php
                                                if ($order_row['status_order'] == 1) {
                                                    echo 'Pending';
                                                } elseif ($order_row['status_order'] == 0) {
                                                    echo 'Approve';
                                                } elseif ($order_row['status_order'] == 2) {
                                                    echo 'Completed';
                                                } elseif ($order_row['status_order'] == -1) {
                                                    echo 'Cancelled';
                                                }
                                                ?>
                                            </h4>



                                        </td>

                                        <td><?php echo $order_row['cart_payment'] ?></td>
                                        <td>
                                            <a href="index.php?action=manageorders&query=vieworder&coder=<?php echo $order_row['code_orders'] ?>">View order details</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </td>
            </tr>
        <?php
        } ?>

    </tbody>
</table>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const dateFromInput = document.querySelector('input[name="datefrom"]');
        const dateToInput = document.querySelector('input[name="dateto"]');


        let selectedDateFrom = '';
        let selectedDateTo = '';


        const form = document.getElementById("orderForm");
        form.addEventListener("submit", function(event) {

            selectedDateFrom = dateFromInput.value;
            selectedDateTo = dateToInput.value;

            sessionStorage.setItem('selectedDateFrom', selectedDateFrom);
            sessionStorage.setItem('selectedDateTo', selectedDateTo);
        });


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





    });
</script>

<script>
    function myFunction() {
        document.getElementById("orderForm").reset();
        document.querySelector('input[type="date"]').value = '';

    }
</script>


<script>
    function toggleText(index) {
        const toggleButton = document.getElementById('toggleButton' + index);
        const hiddenText = document.getElementById('hiddenText' + index);

        // Kiểm tra trạng thái hiện tại của dòng chữ
        if (hiddenText.style.display === 'none') {
            // Nếu dòng chữ đang ẩn, hiển thị nó
            hiddenText.style.display = 'block';
            toggleButton.textContent = 'Hide Text'; // Thay đổi văn bản của nút
        } else {
            // Nếu dòng chữ đang hiển thị, ẩn nó
            hiddenText.style.display = 'none';
            toggleButton.textContent = 'Show Text'; // Thay đổi văn bản của nút
        }
    }
</script>