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
			if(isset($_GET['action']) && $_GET['query'])
			{
				$tam = $_GET['action'];
                $query = $_GET['query'];
			}
			else{
				$tam = '';
                $query = '';
			}
			if($tam == 'managecategory' && $query == 'add')
			{
				include("managecategory/add.php");
                include("managecategory/list.php");
			}
            elseif($tam == 'managecategory' && $query == 'modified')
            {
                include("managecategory/modified.php");
            }	
            elseif($tam == 'manageproducts' && $query == 'add')
            {
                include("manageproduct/add.php");
                include("manageproduct/list.php");
            }
            elseif($tam == 'manageproducts' && $query == 'modified')
            {
                include("manageproduct/modified.php");
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