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
$account_created = False;

require '../vendor/autoload.php';
//Create a new PHPMailer instance;
$mail = new PHPMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//See if request method is post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //open connection to database
    $db = pg_connect("host=ec2-54-163-255-1.compute-1.amazonaws.com port=5432 dbname=d78258r6re094d user=jseqocrbelozuq password=ac7f8466905190ad89da55ed63559f6b09331b96164ac16cfcd27ea02af30536");
    
    if (empty($_POST["first"])) {
        $firstErr = "First name is required";
        $someErr = True;
    } else {
        $first = ($_POST["first"]);
    }
    
    //check if email is already in database
    //$email_query = "SELECT * FROM user_database WHERE email = '$_POST[email]'";
    //$email_result = pg_query($db, $email_query);
    $email_result = pg_query_params($db, 'SELECT * FROM user_database WHERE email = $1', array($_POST[email]));
    $rows = pg_num_rows($email_result);
    
    
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $someErr = True;
    } elseif ($rows > 0) {
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
    
    if (empty($_POST["password"])){
        $passwordErr = "Password is required";
        $someErr = True;
    } elseif($_POST['password'] != $_POST['password-confirm']) {
        $passwordErr = "Passwords did not match";
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
        $cityErr = "Please type your city";
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
            '$first',
            '$last',
            '$address',
            '$city',
            '$state',
            '$zip',
            '$hashedPass',
            '$email')";
            $result = pg_query($db, $query);
            $account_created = True;
} 
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if($account_created) {
    date_default_timezone_set('Etc/UTC');

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
$mail->addReplyTo($email, $first);
$mail->Subject = 'Thank you for signing up for SimplEggs!';
$mail->Body = 'Thanks for signing up for SimplEggs! We look forward to collaborating with you to increase the presence of locally produced eggs!';
$mail->send();
}}
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
                                    <input type="text" name="first" id="first" value="<?php echo $first ?>" placeholder="First Name" />
                                    <?php if ($someErr) {
                                        echo "
                                        <p style='font-size:70%;color:red;'>$firstErr</p>";
                                    }
                                    ?>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <input type="text" name="last" id="last" value="<?php echo $last ?>" placeholder="Last Name" />
                                    <?php if ($someErr) {
                                        echo "
                                        <p style='font-size:70%;color:red;'>$lastErr</p>";
                                    }
                                    ?>
                                </div>
                                <!-- Break -->
                                <!-- Break -->
                                <div class="col-12">
                                    <input type="email" name="email" id="email" value="<?php echo $email ?>" placeholder="Email"</input>
                                    <?php if ($someErr) {
                                        echo "
                                        <p style='font-size:70%;color:red;'>$emailErr</p>";
                                    }
                                    ?>
                                </div>
                                <div class="col-12">
                                    <input type="password" name="password" id="password" value="" placeholder="Password" />
                                </div>
                                <!-- Break -->
                                <div class="col-12">
                                    <input type="password" name="password-confirm" id="password-confirm" value="" placeholder="Re-Enter your Password" />
                                    <?php if ($someErr) {
                                        echo "
                                        <p style='font-size:70%;color:red;'>$passwordErr</p>";
                                    }
                                    ?>
                                </div>
                                <!-- Break -->
                                <div class="col-6 col-12-xsmall">
                                    <input type="text" name="address" id="address" value="<?php echo $address ?>" placeholder="Address" />
                                    <?php if ($someErr) {
                                        echo "
                                        <p style='font-size:70%;color:red;'>$addressErr</p>";
                                    }
                                    ?>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <input type="text" name="city" id="city" value="<?php echo $city ?>" placeholder="City" />
                                    <?php if ($someErr) {
                                        echo "
                                        <p style='font-size:70%;color:red;'>$cityErr</p>";
                                    }
                                    ?>
                                </div>
                                <!-- Break -->
                                <div class="col-6 col-12-xsmall">
                                    <select name="state-category" id="state-category">
                                        <option value="" selected>State</option>
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
                                    <?php if ($someErr) {
                                        echo "
                                        <p style='font-size:70%;color:red;'>$stateErr</p>";
                                    }
                                    ?>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <input type="text" name="zip" id="zip" value="<?php echo $zip ?>" placeholder="Zip Code" />
                                    <?php if ($someErr) {
                                        echo "
                                        <p style='font-size:70%;color:red;'>$zipErr</p>";
                                    }
                                    ?>
                                </div>
                                <!-- Break -->
                                <div class="col-12">
                                    <ul class="actions">
                                        <li><input type="submit" value="Create your account!" class="primary" /></li>
                                        <li><input type="reset" value="Reset" /></li>
                                        <li>
                                            <?php if($account_created) {
                                                echo "<p style='font-size:150%;color:red;'>Account Successfully Created</p>";
                                            }
                                            ?></li>
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
            </div>
            
            <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/browser.min.js"></script>
            <script src="assets/js/breakpoints.min.js"></script>
            <script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>
        </body>
        </html>
        
        <!-- <?php
        // $db = pg_connect("host=ec2-54-163-255-1.compute-1.amazonaws.com port=5432 dbname=d78258r6re094d user=jseqocrbelozuq password=ac7f8466905190ad89da55ed63559f6b09331b96164ac16cfcd27ea02af30536");
        // if (!$db) {
        //     echo "<script type='text/javascript'>alert('an error occured connecting');</script>";
        //     exit;
        // }
        // $query = "INSERT INTO user_database VALUES (
        //     '$_POST[first]',
        //     '$_POST[last]',
        //     '$_POST[address]',
        //     '$_POST[city]',
        //     '$_POST[state]',
        //     '$_POST[zip]',
        //     '$_POST[password]',
        //     '$_POST[email]')";
        // $result = pg_query($db, $query);
        ?> -->
