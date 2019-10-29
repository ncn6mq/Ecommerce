<!DOCTYPE HTML>
<!--
	Homepage for SimplEggs
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
$cost_per_order = (35)/$money_int;
$str_cost = (string) $cost_per_order;
$final_cost = substr($str_cost, 0, 7);

?>

<?php
$curl2 = curl_init();

curl_setopt_array($curl2, array(
  CURLOPT_URL => "https://api.coinbase.com/v2/exchange-rates?currency=BCH",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response2 = curl_exec($curl2);
$err2 = curl_error($curl2);

curl_close($curl2);

$response2 = json_decode($response2, true);
//echo $response2['data']['rates']['USD'];
$money_rate2 =  number_format($response2['data']['rates']['USD']);
$cost_per_order2 = (35)/$money_rate2;
$str_cost_2 = (string) $cost_per_order2;
$final_cost2 = substr($str_cost_2, 0, 7);

?>

<html>
	<head>
		<title>SimplEggs Homepage</title>
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
								  <a href="index.html" class="logo"><img src="images/SimplEggs_Logo.png" alt="SimplEggs" style="height:35px;width:auto;"> by Kieran Heese, Nick Newton, and Zane Alpher</a>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Welcome to SimplEggs</h1>
											<p>An ethical and economic alternative to store-bought eggs </p>
										</header>
										<p>SimplEggs delivers coops, feed, and general support to aid you, the backyard farmer. Whether you are new to raising livestock or an old hand, we make your experience astonishingly easy and rewarding.  </p>
										<ul class="actions">
											<li><a href="sign_up.html" class="button big">Sign Up</a></li>
											<li><a href="login.html" class="button big">Log In</a></li>
										</ul>
									</div>
									<span class="image object">
										<img src="images/chicken_coop_2.jpg" alt="" />
									</span>
								</section>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Quick Facts</h2>
									</header>
									<div class="features">
										<article>
											<span class="icon solid fa-paper-plane"></span>
											<div class="content">
												<h3> Easy Shipping</h3>
												<p>By signing up, we guarantee a quick delivery of your first coop and the necessary supplies to start raising your own environmentally-friendly eggs</p>
											</div>
										</article>
										<article>
											<span class="icon solid fa-rocket"></span>
											<div class="content">
												<h3>Join the Trend</h3>
												<p>Over 4% of Americans already raise chickens from their own home. Will you be next?</p>
											</div>
										</article>
										<article>
											<span class="icon solid fa-signal"></span>
											<div class="content">
												<h3>Save Money</h3>
												<p>The average American consumes 284 eggs per year.  We are offering you the supplies to raise your own eggs and we will even buy up your unused quantities.</p>
											</div>
										</article>
										<article>
										  <div class="content">
										    <h4>Bitcoin price: $<?php echo $money_rate ?> per Bitcoin</h4>
										    <h4>SimplEggs subscription cost: <?php echo $final_cost ?> Bitcoin</h4>
										    <h4>Bitcash price: $<?php echo $money_rate2 ?> per Bitcash</h4>
										    <h4>SimplEggs subscription cost: <?php echo $final_cost2 ?> Bitcash</h4>
										    <p>We charge a constant price of $10/month for feed and all other amenities for your chicken.  These prices fluctuate in terms of bitcoin so we have converted it for you right here</p>
										</article>
									</div>
								</section>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>What We Offer</h2>
									</header>
									<div class="posts">
										<article>
											<a href="#" class="image"><img src="images/chicken_coop_1.jpg" alt="" /></a>
											<h3>Our Coops - Lightweight, Durable, and Easy to Construct</h3>
											<p>Our easy to follow guide makes setting up a simple process for even the most inexperienced builders.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="images/eggs_1.jpg" alt="" /></a>
											<h3>The Eggs</h3>
											<p>Prepare for fresh, ethically produced eggs every morning, direct from your farm to your table.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="images/baby_chicken_in_hand_1.jpg" alt="" /></a>
											<h3>Helpful Training Videos</h3>
											<p>Our suite of training videos covers every topic imaginable allowing you to hit the ground running without any prior training.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="images/chicken_feed_2.jpg" alt="" /></a>
											<h3>Weekly Shipping</h3>
											<p>We will routinely ship your feed to you, ensuring that the feed is in your hands well before you need it.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
									</div>
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

