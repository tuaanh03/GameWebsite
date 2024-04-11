<?php
if(isset($_GET['manage']))
{
	$tam = $_GET['manage'];
}
else{
	$tam = '';
}
if($tam == '')
{
	include("pages/slider.php");
}
?>
<main class="main-content">
	<div class="container">
		<div class="page">
			<?php
			if(isset($_GET['manage']))
			{
				$tam = $_GET['manage'];
			}
			else{
				$tam = '';
			}
			if($tam == 'product')
			{
				include("main/productlist.php");
			}
			elseif($tam == 'cart')
			{
				include("main/cart.php");
			}
			elseif($tam == 'news')
			{
				include("main/news.php");
			}
			else
			{
				include("main/mainproductlist.php");
			}
			?>
		</div>
	</div> <!-- .container -->
</main> <!-- .main-content -->