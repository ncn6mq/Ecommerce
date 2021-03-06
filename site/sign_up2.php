<!DOCTYPE HTML>
<!--
Editorial by HTML5 UP
html5up.net | @ajlkn
Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->


<?php
// define variables and set to empty values
$firstErr = $emailErr = $lastErr = $passwordErr = $addressErr = $cityErr = $stateErr = $zipErr = $emailExistErr = "";
$first = $email = $last = $password = $address = $city = $state = $zip = $hashedPass = "";
$someErr = False;

//See if request method is post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //open connection to database
    $db = pg_connect("host=ec2-54-163-255-1.compute-1.amazonaws.com port=5432 dbname=d78258r6re094d user=jseqocrbelozuq password=ac7f8466905190ad89da55ed63559f6b09331b96164ac16cfcd27ea02af30536");
    if (!$db) {
        echo "<script type='text/javascript'>alert('an error occured connecting');</script>";
        exit;
    }
    
    if (empty($_POST["first"])) {
        $nameErr = "First name is required";
        $someErr = True;
    } else {
        $first = ($_POST["first"]);
    }
    
    //check if email is already in database
    $email_query = "SELECT COUNT(*) FROM user_database WHERE email = '$_POST[email]'";
    $email_result = pg_query($db, $email_query);
    
    if (empty($_POST["email"])) {
        $emailErr = "Email is incorrectly input";
        $someErr = True;
    } else if ($email_result == 0) {
        $emailErr = "Email already in use";
        $someErr = True;
    } else {
        $email = ($_POST["email"]);
    }
    
    if (empty($_POST["last"])) {
        $lastErr = "Last name is required";
        $someErr = True;
    } else {
        $last = ($_POST["last"]);
    }
    
    if (empty($_POST["password"]) Or empty($_POST["password-confirm"]) Or ($_POST['password'] != $_POST['password-confirm'])) {
        $passwordErr = "One password was empty or they did not match";
        $someErr = True;
    } else {
        $password = ($_POST["password"]);
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
    }
    
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
        $someErr = True;
    } else {
        $address = ($_POST["address"]);
    }
    
    if (empty($_POST["city"])) {
        $cityErr = "City is required";
        $someErr = True;
    } else {
        $city = ($_POST["city"]);
    }
    
    if (empty($_POST["state-category"])) {
        $stateErr = "State must be selected";
        $someErr = True;
    } else {
        $state  = ($_POST["state-category"]);
    }
    
    if(empty($_POST["zip"]) Or !preg_match('#[0-9]{5}#', $_POST["zip"])) {
        $zipErr = "Incorrect zip code format";
        $someErr = True;
    }
    else {
        $zip = $_POST["zip"];
    }
    
    
    if(!$someErr) {
        //insert new user into database if no errors
        $query = "INSERT INTO user_database VALUES (
            '$_POST[first]',
            '$_POST[last]',
            '$_POST[address]',
            '$_POST[city]',
            '$_POST[state]',
            '$_POST[zip]',
            '$_POST[password]',
            '$_POST[email]'
        )";
        date_default_timezone_set('Etc/UTC');
        $result = pg_query($db, $query);
        
        
        // Send confirmation email
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        
        
        
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);
        
        
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'simple.eggs.biz@gmail.com';                     // SMTP username
        $mail->Password   = 'CS4753Ecommerce';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
        
        //Recipients
        $mail->setFrom('simple.eggs.biz@gmail.com', 'Simple Eggs');
        $mail->addAddress($_POST[email], $_POST[first]);     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Thank You for signing up!';
        $mail->Body    = 'Thanks for signing up for <b>SimplEggs!</b> We will get your eggs to you in no time';
        $mail->AltBody = 'Thanks for signing up for simpleggs!';
        
        $mail->send();
        
    }
}

?>


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
                                <select name="state-category" id="state-category">
                                    <option value="">Which state are you from?</option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>
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
    </div>
    
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    
    <?php
    //Check for some error, this is how I'm outputting it but I could output it further up
    if ($someErr) {
        echo "<h2>There was an error!</h2>";
        echo $firstErr;
        echo "</br>";
        echo $lastErr;
        echo "</br>";
        echo $emailErr;
        echo "</br>";
        echo $passwordErr;
        echo "</br>";
        echo $addressErr;
        echo "</br>";
        echo $cityErr;
        echo "</br>";
        echo $stateErr;
        echo "</br>";
        echo $zipErr;
        echo "</br>";
    }
    ?>
</body>
</html>