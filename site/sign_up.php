<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>SimplEggs - Sign Up</title>
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
									<header class="main">
										<h1>Sign Up!</h1>
									</header>

									<h3>Fill out this form to join SimplEggs</h3>

									<form method="post" action="sign_up.php">
									  <div class="row gtr-uniform">
									    <div class="col-6 col-12-xsmall">
									      <input type="text" name="first" id="first" value="" placeholder="First Name" />
									    </div>
									    <div class="col-6 col-12-xsmall">
									      <input type="text" name="last" id="last" value="" placeholder="Last Name" />
									    </div>
									    <!-- Break -->
									    <div class="col-12">
									      <select name="demo-category" id="demo-category">
										<option value="">-Which product are you interested in? -</option>
										<option value="1">The Simple Starter Kit - A coop, seed, and hatchlings </option>
										<option value="1">Renewal - Seed and some hatchlings </option>
										<option value="1">Bi-monthly Delivery - Seed and hatchlings  </option>
										<option value="1">Monthly Delivery - Seed </option>
									      </select>
									    </div>
									    <!-- Break -->
									    <div class="col-12">
									      <input type="text" name="email" id="email" value="" placeholder="Email"</input>
									    </div>
									    <div class="col-12">
									      <input type="password" name="password" id="password" value="" placeholder="Password" />
									    </div>
									     <!-- Break -->
									    <div class="col-12">
									      <input type="password" name="password-confirm" id="password-confirm" value="" placeholder="Re-Enter your Password" />
									    </div>
										<!-- Break -->
										<div class="col-6 col-12-xsmall">
										  <input type="text" name="address" id="address" value="" placeholder="Address" />
										</div>
										<div class="col-6 col-12-xsmall">
										  <input type="text" name="city" id="city" value="" placeholder="City" />
										</div>
									    <!-- Break -->
										<div class="col-6 col-12-xsmall">
										  <input type="text" name="state" id="state" value="" placeholder="State" />
										</div>
										<div class="col-6 col-12-xsmall">
										  <input type="text" name="zip" id="zip" value="" placeholder="Zip Code" />
										</div>
									    <!-- Break -->
									    <div class="col-12">
									      <ul class="actions">
										<li><input type="submit" value="Create your account!" class="primary" /></li>
										<li><input type="reset" value="Reset" /></li>
									      </ul>
									    </div>
									  </div>
									</form>
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

<?php
    $db = pg_connect("host=ec2-54-163-255-1.compute-1.amazonaws.com port=5432 dbname=d78258r6re094d user=jseqocrbelozuq password=ac7f8466905190ad89da55ed63559f6b09331b96164ac16cfcd27ea02af30536");
    if (!$db) {
        echo "<script type='text/javascript'>alert('an error occured connecting');</script>";
        exit;
    }
    $query = "INSERT INTO user_database VALUES (
        '$_POST[first]',
        '$_POST[last]',
        '$_POST[address]',
        '$_POST[city]',
        '$_POST[state]',
        '$_POST[zip]',
        '$_POST[password]',
        '$_POST[email]')";
    $result = pg_query($db, $query);
?>

