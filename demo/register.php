<?php
$con = mysqli_connect("localhost", "root", "", "social");

if (mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_errno();
}

// declaring var to prevent erros
$fname = ""; // dba_first
$lname = ""; // last name
$em = ""; //email
$password = "";
$password2 = "";
$date = "";  //sign up date
$error_array = "";  //holds error messages

if (isset($_POST['register_button'])) {
    //registration form values
    // first name
    $fname = strip_tags($_POST['reg_fname']);  //remove html tags
    $fname = str_replace(' ', '', $fname);  // remove spaces
    $fname = ucfirst(strtolower($fname));   // uppercase only first letter
    // last name
    $lname = strip_tags($_POST['reg_lname']);  //remove html tags
    $lname = str_replace(' ', '', $lname);  // remove spaces
    $lname = ucfirst(strtolower($lname));   // uppercase only first letter
    // email1
    $em = strip_tags($_POST['reg_email']);
    $em = str_replace(' ', '', $em);  // remove spaces
    $em = ucfirst(strtolower($em));   // uppercase only first letter;;;;

    // email2
    $em2 = strip_tags($_POST['reg_email2']);
    $em2 = str_replace(' ', '', $em2);  // remove spaces
    $em2 = ucfirst(strtolower($em2));   // uppercase only first letter
    //psw
    $password = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']);

    $date = date("Y-m-d"); //current date

    if ($em == $em2) {
        if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);
        } else {
            echo "Invalid email format";

        }
    } else {
        echo "emails don't match";
    }
}



?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> welcom to Swirlfeed!</title>
  </head>
  <body>

    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" value="" placeholder="First Name" required>
        <br>
        <input type="text" name="reg_lname" value="" placeholder="Last Name" required>
        <br>
        <input type="text" name="reg_email" value="" placeholder="Email" required>
        <br>
        <input type="text" name="reg_email2" value="" placeholder="Confirm Email" required>
        <br>
        <input type="text" name="reg_password" value="" placeholder="Password" required>
        <br>
        <input type="text" name="reg_password2" value="" placeholder="Confirm Password" required>
        <br>
        <input type="submit" name="register_button" value="Register">
    </form>

  </body>
</html>
