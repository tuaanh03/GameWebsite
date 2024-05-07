<?php
session_start();
if (!isset($_SESSION['dangnhap'])) {
    header('Location:login.php');
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
    <!-- CSS MORRIS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>

<body>
    <div id="wrapper">
        <?php
        include("config/config.php");
        include("modules/header.php");
        include("modules/menu.php");
        include("modules/main.php");
        ?>


    </div>
    <?php
    include("modules/footer.php");

    ?>


    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <!-- JS MORRIS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        $(document).ready(function() {
            thongke();
            var char = new Morris.Area({

                element: 'myfirstchart',

                xkey: 'date',

                ykeys: ['date', 'order', 'sales', 'quantity'],

                labels: ['Orders', 'Profit', 'Quantity']
            });

            function thongke() {
                var text = '365 ngày qua';
                $('#text-date').text(text);
                $.ajax({
                    url: "modules/thongke.php",
                    method: "POST",
                    dataType: "JSON",

                    success: function(data) {
                        char.setData(data);
                        $('#text-date').text(text);
                    }
                })
            }
        });
    </script>

    <script>
        function imagePreview(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function(event) {
                    $('#preview').html('<img src="' + event.target.result + '" width="150px" height="auto"/>');
                };
                fileReader.readAsDataURL(fileInput.files[0]);
            }
        }
        $("#image").change(function() {
            imagePreview(this);
        });
    </script>


</body>

</html>