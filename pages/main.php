<?php
$tam = isset($_GET['manage']) ? $_GET['manage'] : '';
$control = isset($_GET['control']) ? $_GET['control'] : '';
if($tam == '' && $control == '')
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

			// elseif($tam == 'payment')
			// {
			// 	include("main/payment.php");
			// }

			elseif($tam == 'thankyou')
			{
				include("main/thankyou.php");
			}

			elseif($tam == 'shipping')
			{
				include("main/shipping.php");
			}

			elseif($tam == 'payment')
			{
				include("main/inforpayment.php");
			}
			
			elseif($tam == 'alreadyorder')
			{
				include("main/detailbill.php");
			}

			elseif($tam == 'historypurchase')
			{
				include("main/historypurchase.php");
			}

			elseif($tam == 'viewbill')
			{
				include("main/viewbill.php");
			}

			elseif($tam == 'profile' && $control == 'viewprofile')
			{
				include("main/profile.php");
			}

			elseif($tam == 'profile' && $control == 'viewhistoryorder')
			{
				include("main/profile.php");
			}


			else
			{
				include("main/mainproductlist.php");
			}
			?>
		</div>
	</div> <!-- .container -->
</main> <!-- .main-content -->