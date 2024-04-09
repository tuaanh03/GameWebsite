<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Ecommerce Video Game | Cart</title>

		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:100,300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="fonts/lineo-icon/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/boostrap.min.css">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="css/style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>


	<body class="slider-collapse">
		
		<div id="site-content">
			<div class="site-header">
				<div class="container">
					<a href="index.php" id="branding">
						<img src="images/logo.png" alt="" class="logo">
						<div class="logo-text">
							<h1 class="site-title">Company name</h1>
							<small class="site-description">Tagline goes here</small>
						</div>
					</a> <!-- #branding -->

					<div class="right-section pull-right">
						<a href="cart.php" class="cart"><i class="icon-cart"></i> 0 items in cart</a>
						<a href="#" class="login-button">Login/Register</a>
					</div> <!-- .right-section -->

					<div class="main-navigation">
						<button class="toggle-menu"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item home "><a href="index.php"><i class="icon-home"></i></a></li>
							<li class="menu-item drop-down">
								<a class="nav-link" href="#" id="navbarDropdown" role="button" aria-expanded="false">
									Games
								</a>
								  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									<li><a class="dropdown-item" href="products.php"><label for="" class="psicon"><img src="images/free-playstation-40-739542.webp" alt=""></label>Playstation 5</a></li>
									<li><a class="dropdown-item" href="#"><label for="" class="psicon"><img src="images/free-playstation-40-739542.webp" alt=""></label>Playstation 4</a></li>
									<li><a class="dropdown-item" href="#"><label for="" class="psicon"><img src="images/microsoft_xbox_icon_136396.png" alt=""></label>Xbox Series X|S</a></li>
									<li><a class="dropdown-item" href="#"><label for="" class="psicon"><img src="images/nintendo_switch_icon_136357.png" alt=""></label>Nintendo Switch</a></li>
									<li><a class="dropdown-item" href="#"><label for="" class="psicon"><img src="images/pc-screen-icon-2048x1793-ic9fcuzs.png" alt=""></label>PC</a></li>								
								  </ul>
							</li>
							<li class="menu-item drop-down">
								<a class="nav-link" href="#" id="navbarDropdown" role="button"  aria-expanded="false">
									PS5
								</a>
								  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									<li><a class="dropdown-item" href="#">Console</a></li>
									<li><a class="dropdown-item" href="#">Games</a></li>
									<li><a class="dropdown-item" href="#">Controllers</a></li>
									<li><a class="dropdown-item" href="#">Headsets</a></li>
									
								  </ul>
							</li>
							<li class="menu-item drop-down">
								<a class="nav-link" href="#" id="navbarDropdown" role="button"  aria-expanded="false">
									PS4
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									<li><a class="dropdown-item" href="#">Console</a></li>
									<li><a class="dropdown-item" href="#">Games</a></li>
									<li><a class="dropdown-item" href="#">Controllers</a></li>
									<li><a class="dropdown-item" href="#">Headsets</a></li>
									
								  </ul>
							</li>
							<li class="menu-item drop-down">
								<a class="nav-link" href="#" id="navbarDropdown" role="button" aria-expanded="false">
									Accessories
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									<li><a class="dropdown-item" href="#">Console <label for="" class="psicon"><img src="images/free-playstation-40-739542.webp" alt=""></label></a></li>
									<li><a class="dropdown-item" href="#">Games</a></li>
									<li><a class="dropdown-item" href="#">Controllers</a></li>
									<li><a class="dropdown-item" href="#">Headsets</a></li>
									
								  </ul>
							</li>
							<li class="menu-item"><a class="nav-link" href="#" id="navbarDropdown" role="button"  aria-expanded="false">
								New
							</a></li>
							
						</ul> <!-- .menu -->
						<div class="search-form">
							<label><img src="images/icon-search.png"></label>
							<input type="text" placeholder="Search...">
						</div> <!-- .search-form -->

						<div class="mobile-navigation"></div> <!-- .mobile-navigation -->
					</div> <!-- .main-navigation -->
				</div> <!-- .container -->
			</div> <!-- .site-header -->

			<div class="home-slider">
				<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-indicators">
					  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
					  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
					  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
					</div>
					<div class="carousel-inner">
					  <div class="carousel-item active" id="c-item" >
						<img src="images/ark-survival-ascended.jpg" class="d-block w-75 p-5 mx-auto" id="c-image" alt="...">
					  </div>
					  <div class="carousel-item " id="c-item">
						<img src="images/elden-ring.jpg" class="d-block w-75 p-5 mx-auto" id="c-image" alt="...">
					  </div>
					  <div class="carousel-item " id="c-item">
						<img src="images/codmwIII.jpg" class="d-block w-75 p-5 mx-auto" id="c-image" alt="...">
					  </div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
					  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					  <span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
					  <span class="carousel-control-next-icon" aria-hidden="true"></span>
					  <span class="visually-hidden">Next</span>
					</button>
				  </div>
			</div> <!-- .home-slider -->

			<main class="main-content">
				<div class="container">
					<div class="page">
						<section>
							<header>
								<h2 class="section-title">New Products</h2>
								<a href="single.php" class="all">Show All</a>
							</header>

							<div class="product-list">
								<div class="product">
									<img src="images/nintendo-pokemonMysteryDungeonRescueTeam.jpg" alt="" class="card-image">
									<div class="card-content">
										<div class="card-top">
											<h3 class="card-title">Elden Ring</h3>
										</div>
										<div class="card-bottom">
											<span class="gia">420000đ</span>
										</div>
									</div>
								</div>
								<div class="product">
									<img src="images/ps4-daysgone.webp" alt="" class="card-image">
									<div class="card-content">
										<div class="card-top">
											<h3 class="card-title">Elden Ring Elden Ring Elden Ring Elden Ring</h3>
										</div>
										<div class="card-bottom">
											<span class="gia">420000đ</span>
										</div>
									</div>
								</div>
								<div class="product">
									<img src="images/ps4-avatar.jpg" alt="" class="card-image">
									<div class="card-content">
										<div class="card-top">
											<h3 class="card-title">Elden RingRingRingRingRingRingRingRingRingRingRingRing</h3>
										</div>
										<div class="card-bottom">
											<span class="gia">420000đ</span>
										</div>
									</div>
								</div>
								<div class="product">
									<img src="images/ps4-gtaV.webp" alt="" class="card-image">
									<div class="card-content">
										<div class="card-top">
											<h3 class="card-title">Elden Ring</h3>
										</div>
										<div class="card-bottom">
											<span class="gia">420000đ</span>
										</div>
									</div>
								</div>

							</div> <!-- .product-list -->

						</section>

						<section>
							<header>
								<h2 class="section-title">New Products</h2>
								<a href="#" class="all">Show All</a>
							</header>

							<div class="product-list">
								<div class="product">
									<img src="images/ps5-codmwII.jpg" alt="" class="card-image">
									<div class="card-content">
										<div class="card-top">
											<h3 class="card-title">Elden Ring</h3>
										</div>
										<div class="card-bottom">
											<span class="gia">420000đ</span>
										</div>
									</div>
								</div>
								<div class="product">
									<img src="images/ps5-eldenring.jpg" alt="" class="card-image">
									<div class="card-content">
										<div class="card-top">
											<h3 class="card-title">Elden Ring Elden Ring Elden Ring Elden Ring </h3>
										</div>
										<div class="card-bottom">
											<span class="gia">420000đ</span>
										</div>
									</div>
								</div>
								<div class="product">
									<img src="images/ps5-residentevil4.jpg" alt="" class="card-image">
									<div class="card-content">
										<div class="card-top">
											<h3 class="card-title">Elden RingRingRingRingRingRingRingRingRingRingRingRing</h3>
										</div>
										<div class="card-bottom">
											<span class="gia">420000đ </span>
										</div>
									</div>
								</div>
								<div class="product">
									<img src="images/ps5-minecraftlegend.jpg" alt="" class="card-image">
									<div class="card-content">
										<div class="card-top">
											<h3 class="card-title">Elden Ring</h3>
										</div>
										<div class="card-bottom">
											<span class="gia">420000đ</span>
										</div>
									</div>
								</div>

							</div> <!-- .product-list -->

						</section>
					</div>
				</div> <!-- .container -->
			</main> <!-- .main-content -->

			<div class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Information</h3>
								<ul class="no-bullet">
									<li><a href="#">Site map</a></li>
									<li><a href="#">About us</a></li>
									<li><a href="#">FAQ</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Contact</a></li>
								</ul>
							</div> <!-- .widget -->
						</div> <!-- column -->
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Consumer Service</h3>
								<ul class="no-bullet">
									<li><a href="#">Secure</a></li>
									<li><a href="#">Shipping &amp; Returns</a></li>
									<li><a href="#">Shipping</a></li>
									<li><a href="#">Orders &amp; Returns</a></li>
									<li><a href="#">Group Sales</a></li>
								</ul>
							</div> <!-- .widget -->
						</div> <!-- column -->
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">My Account</h3>
								<ul class="no-bullet">
									<li><a href="#">Login/Register</a></li>
									<li><a href="#">Settings</a></li>
									<li><a href="#">Cart</a></li>
									<li><a href="#">Order Tracking</a></li>
									<li><a href="#">Logout</a></li>
								</ul>
							</div> <!-- .widget -->
						</div> <!-- column -->
						<div class="col-md-6">
							<div class="widget">
								<h3 class="widget-title">Join our newsletter</h3>
								<form action="#" class="newsletter-form">
									<input type="text" placeholder="Enter your email...">
									<input type="submit" value="Subsribe">
								</form>
							</div> <!-- .widget -->
						</div> <!-- column -->
					</div><!-- .row -->

					<div class="colophon">
						<div class="copy">Copyright 2014 Company name. Designed by Themezy. All rights reserved.</div>
						<div class="social-links square">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-google-plus"></i></a>
							<a href="#"><i class="fa fa-pinterest"></i></a>
						</div> <!-- .social-links -->
					</div> <!-- .colophon -->
				</div> <!-- .container -->
			</div> <!-- .site-footer -->
		</div>

		<div class="overlay"></div>

		<div class="auth-popup popup">
			<a href="#" class="close"><i class="fa fa-times"></i></a>
			<div class="row">
				<div class="col-md-6">
					<h2 class="section-title">Login</h2>
					<form action="#">
						<input type="text" placeholder="Username...">
						<input type="password" placeholder="Password...">
						<input type="submit" value="Login">
					</form>
				</div> <!-- .column -->
				<div class="col-md-6">
					<h2 class="section-title">Create an account</h2>
					<form action="#">
						<input type="text" placeholder="Username...">
						<input type="text" placeholder="Email address...">
						<input type="submit" value="register">
					</form>
				</div> <!-- .column -->
			</div> <!-- .row -->
		</div> <!-- .auth-popup -->

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
		<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	</body>
	
</html>