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
			elseif($tam == 'carts')
			{
				include("main/cart.php");
			}
			elseif($tam == 'singleproduct')
			{
				include("main/singleproduct.php");
			}
			elseif($tam == 'register')
			{
				include("main/register.php");
			}
			elseif($tam == 'login')
			{
				include("main/login.php");
			}
			elseif($tam == 'search')
			{
				include("main/search.php");
			}
			elseif($tam == 'news')
			{
				include("main/news.php");
			}
			elseif($tam == 'payment')
			{
				include("main/payment.php");
			}
			
			else
			{
				include("main/mainproductlist.php");
			}
			?>
		</div>
	</div> <!-- .container -->
</main> <!-- .main-content -->