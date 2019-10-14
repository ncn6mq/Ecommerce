<!DOCTYPE html>
<head>
</head>
<body>
    <h2>Enter information</h2>
    <ul>
        <form name="insert" action="index.php" method="POST" >
            <li>first:</li><li><input type="text" name="first" /></li>
            <li>last:</li><li><input type="text" name="last" /></li>
            <li>address:</li><li><input type="text" name="address" /></li>
            <li>city:</li><li><input type="text" name="city" /></li>
            <li>state:</li><li><input type="text" name="state" /></li>
            <li>zip:</li><li><input type="text" name="zip" /></li>
            <li>password:</li><li><input type="text" name="password" /></li>
            <li>email:</li><li><input type="text" name="email" /></li>
            <li><input type="submit" /></li>
        </form>
    </ul>
</body>
</html>
<?php
    $db = pg_connect("host=ec2-54-163-255-1.compute-1.amazonaws.com port=5432 dbname=postgres user=d78258r6re094d password=ac7f8466905190ad89da55ed63559f6b09331b96164ac16cfcd27ea02af30536");
    echo "<script type='text/javascript'>alert('$db');</script>";
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