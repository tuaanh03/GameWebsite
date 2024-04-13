<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-lg-12">
                <h2>ADMIN DASHBOARD</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-lg-12 ">
                <div class="alert alert-info">
                    <strong>Welcome Jhon Doe ! </strong>
                </div>
            </div>
        </div>
        <!-- /. ROW  -->
        <?php
			if(isset($_GET['action']))
			{
				$tam = $_GET['action'];
			}
			else{
				$tam = '';
			}
			if($tam == 'managecategory')
			{
				include("managecategory/add.php");
                include("managecategory/list.php");
			}		
			else
			{
				include("dashboard.php");
			}
			?>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->