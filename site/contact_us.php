<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
  -->

<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\OAuth;
// Alias the League Google OAuth2 provider class
//use League\OAuth2\Client\Provider\Google; 


if (array_key_exists('user-message', $_POST)) {
    date_default_timezone_set('Etc/UTC');
    require '../vendor/autoload.php';

    //Create a new PHPMailer instance;
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP - requires a local mail server;
    //Faster and safer than using mail();
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'simple.eggs.biz@gmail.com';
    //Password to use for SMTP authentication
    $mail->Password = 'CS4753Ecommerce';
    //Set who the message is to be sent from
    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('simple.eggs.biz@gmail.com', 'Simple Eggs');
    //Send the message to yourself, or whoever should receive contact for submissions
    $mail->addAddress('simple.eggs.biz@gmail.com', 'Simple Eggs');
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    $mail->addReplyTo('kheese123@gmail.com', 'Simple Eggs2'); 
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'PHPMailer contact form';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Category: {$_POST['issue-category']}
Username (if any): {$_POST['username']}
Message: {$_POST['user-message']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but you shouldn't display errors to users - process the error, log it on your server.
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }
}
?>

<html>
	<head>
		<title>SimplEggs - Contact Us</title>
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
										<h1>Contact Us</h1>
									</header>
									<h3>Send us a message</h3>
									<form method="post" action="contact_us.php">
									  <div class="row gtr-uniform">
									    <div class="col-4 col-12-xsmall">
									      <input type="text" name="name" id="name" value="" placeholder="Name" />
									    </div>
									    <div class="col-4 col-12-xsmall">
									      <input type="email" name="email" id="email" value="" placeholder="Email" />
									    </div>
									    <div class="col-4 col-12-xsmall">
									      <input type="text" name="username" id="username" value="" placeholder="Username (If Any)" />
									    </div>
									    <!-- Break -->
									    <div class="col-12">
									      <select name="issue-category" id="issue-category">
										<option value="other">- What is the nature of this issue? -</option>
										<option value="potential-customer">Potential Customer Question</option>
										<option value="wrong-delivery">Missed/wrong delivery</option>
										<option value="customer-experience">How can we improve your customer experience</option>
										<option value="other">Other</option>
									      </select>
									    </div>
									    <!-- Break -->
									    <!-- Break -->
									    <div class="col-12">
									      <textarea name="user-message" id="user-message" placeholder="Enter your message" rows="6"></textarea>
									    </div>
									    <!-- Break -->
									    <div class="col-12">
									      <ul class="actions">
										<li><input type="submit" value="Send Message" class="primary" /></li>
										<li><input type="reset" value="Reset" /></li>
									      </ul>
									    </div>
									  </div>
									</form>
								</section>
								<section>
								  <h1>Contact Our Team</h1>
								  <div class="row gtr-uniform">
								    <div class="col-4 col-12-xsmall">
								      <h4>Nicholas Newton</h4>
								    </div>
								    <div class="col-4 col-12-xsmall">
								      <h4>Kieran Heese</h4>
								    </div>
								    <div class="col-4 col-12-xsmall">
								      <h4>Zane Alpher</h4>
								    </div>
								    <div class="col-4 col-12-xsmall">
								     <img src="images/NickNewton_web.jpg" alt="" style="width:150px;height:auto;">
								    </div>
								    <div class="col-4 col-12-xsmall">
								      <img src="images/Kieran_Heese_web.jpg" alt="" style="width:150px;height:auto;">
								    </div>
								    <div class="col-4 col-12-xsmall">
								      <img src="images/ZaneAlpher_web.jpg" alt="" style="width:150px;height:auto;">
								    </div>
								    <div class="col-4 col-12-xsmall">
								      <p>Email: ncn6mq@virginia.edu</p>
								    </div>
								    <div class="col-4 col-12-xsmall">
								      <p>Email: kh8fb@virginia.edu</p>
								    </div>
								    <div class="col-4 col-12-xsmall">
								      <p>Email: za3df@virginia.edu</p>
								    </div>
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
