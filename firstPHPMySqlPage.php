<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>First MySql DB Demo</title>
    </head>
    <body>
        <?php
        $dbhost = 'localhost';
        $dbport = '3036';
        $dbuser = 'test_user';
        $dbpass = 'test123';
        $dbname = 'test';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (!$conn) {
            echo "Could not connect: " . mysqli_connect_errno() . PHP_EOL;
        } else {
            echo 'Connected successfully';
            echo "</br>Host information: " . mysqli_get_host_info($conn) . PHP_EOL;
            mysqli_close($conn);
        }
        ?>
    </body>
</html>
