

<?php
$con = mysqli_connect("localhost", "root", "", "social");

if (mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_errno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'mi')");

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title> SwirlFeed</title>
    </head>
    <body>
        Hello Chuan !!!!!!!!!
    </body>
</html>
