<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
  -->

<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.coinbase.com/v2/exchange-rates?currency=BTC",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$response = json_decode($response, true);
$money_rate =  $response['data']['rates']['USD'];
$money_string = str_replace( ',', '', $money_rate );
$money_int = (int) $money_string;
$cost_per_order = (250)/$money_int;
$str_cost = (string) $cost_per_order;
$final_cost_one_time = substr($str_cost, 0, 5);
$cost_per_order2 = (35)/$money_int;
$str_cost2 = (string) $cost_per_order2;
$final_cost_subscription = substr($str_cost2, 0, 5);

?>

<html>
	<head>
		<title>SimplEggs - Log In</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="index.php" class="logo"><img src="images/SimplEggs_Logo.png" alt="SimplEggs" style="height:35px;width:auto;"> by Kieran Heese, Nick Newton, and Zane Alpher</a>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									</ul>
								</header>

							<!-- Content -->
								<section>
									<h1>Products</h1>
								</section>
								<section id="banner">
									<div class="content">
										<header>
											<h2>Monthly Feed Shipment</h2>
										</header>
										<p>Every month, we will deliver chicken feed right to your door. You will never need to leave the confort of your own home to go buy feed. Purchase monthly or just whenever your feed storage gets low.</p>
										<p><b>$35 or <?php echo $final_cost_subscription ?> BTC</b></p>
									</div>
									<span class="image object">
										<img src="images/chicken_feed_2.jpg" alt="" style="height:50%;width=50%;"/>
									</span>
								</section>
								<section id="banner">
									<div class="content">
										<header>
											<h2>Chicken Coop</h2>
										</header>
										<p>We will deliver the materials and instructions straight to you. All you need is a hammer, screwdriver, and a few hours to set it up.</p>
										<p><b>$250 or <?php echo $final_cost_one_time ?> BTC</b></p>
									</div>
									<span class="image object">
										<img src="images/chicken_coop_2.jpg" alt="" style="height:50%;width=50%;"/>
									</span>
								</section>
								
						</div>
					</div>

			<!-- Sidebar -->
					<div id="sidebar">
					  <div class="inner">

					    <!-- Search -->
					    <section id="search" class="alt">
					      <form method="post" action="#">
						<input type="text" name="query" id="query" placeholder="Search" />
					      </form>
					    </section>

					    <!-- Menu -->
					    <nav id="menu">
					      <header class="major">
						<h2>Menu</h2>
					      </header>
					      <ul>
						<li><a href="index.php">Homepage</a></li>
						<li><a href="login.php">Log In</a></li>
						<li><a href="sign_up.php">Sign Up</a></li>
						<li><a href="products.php">Products</a></li>
						<li><a href="about_us.php">About Us</a></li>
						<li><a href="contact_us.php">Contact Us</a></li>	
					      </ul>
					    </nav>

					    <!-- Section -->
					    <section>
					      <header class="major">
						<h2>Articles</h2>
					      </header>
					      <div class="mini-posts">
						<article>
						  <a href="https://www.nytimes.com/2009/08/04/business/04chickens.html" class="image"><img src="images/nyt_chickens.jpg" alt="" /></a>
						  <h2>Keeping Their Eggs in Backyard Nests</h2>
						  <p>As layoffs increase, Americans are seeking a self-sustained food option for when the bills can't be paid. - <i> New York Times </i></p>
						</article>
						<article>
						  <a href="https://www.cdc.gov/salmonella/backyardpoultry-05-19/index.html" class="image"><img src="images/backyard_chicken_1.jpg" alt="" /></a>
						  <h2>Don't Kiss Your Chickens!</h2>
						  <p>Outbreaks of Salmonella infections linked to backyard poultry - <i> Center for Disease Control </i></p>
						</article>
					    </section>
					    </div>
					  </div>

					</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
