<?php

session_start();

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
$error_array = [];  //holds error messages

if (isset($_POST['register_button'])) {
    //registration form values
    // first name
    $fname = strip_tags($_POST['reg_fname']);  //remove html tags
    $fname = str_replace(' ', '', $fname);  // remove spaces
    $fname = ucfirst(strtolower($fname));   // uppercase only first letter
    $_SESSION['reg_fname'] = $fname;  // store info seesion var
    // last name
    $lname = strip_tags($_POST['reg_lname']);  //remove html tags
    $lname = str_replace(' ', '', $lname);  // remove spaces
    $lname = ucfirst(strtolower($lname));   // uppercase only first letter
    $_SESSION['reg_lname'] = $lname;  // store info seesion var
    // email1
    $em = strip_tags($_POST['reg_email']);
    $em = str_replace(' ', '', $em);  // remove spaces
    $em = ucfirst(strtolower($em));   // uppercase only first letter;;;;
    $_SESSION['reg_email'] = $em;  // store info seesion var

    // email2
    $em2 = strip_tags($_POST['reg_email2']);
    $em2 = str_replace(' ', '', $em2);  // remove spaces
    $em2 = ucfirst(strtolower($em2));   // uppercase only first letter
    $_SESSION['reg_email2'] = $em2;  // store info seesion var
    //psw
    $password = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']);

    $date = date("Y-m-d"); //current date

    if ($em == $em2) {
        if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);
            //check if email is already exists
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
            //count the number of rows returnd
            $num_rows = mysqli_num_rows($e_check);

            if ($num_rows > 0) {
                array_push($error_array,  "email already in use<br>");
            }
        } else {
            array_push($error_array, "Invalid email format<br>");

        }
    } else {
        array_push($error_array, "emails don't match<br>");
    }

    if (strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($error_array, "yoru first anme must bwt 2 and 25 characters<br>");
    }

    if (strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($error_array, "yoru last anme must bwt 2 and 25 characters<br>");
    }

    if ($password != $password2) {
        array_push($error_array, "password not match<br>");
    } else if (preg_match('/[^A-Za-z0-9]/', $password)) {
        array_push($error_array, "your password can only contain english char or numbrs<br>");
    }

    if (strlen($password > 30 || strlen($password) < 5)) {
        array_push($error_array, 'your password len must btw 5 and 30 chars<br>');
    }

    if (empty($error_array)) {
        $password = md5($password);  //encrypt psw before send to db
        //gen username by concatenating first name and last name
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        $i = 0;
        // if username exists dd number to username
        while (mysqli_num_rows($check_username_query) != 0) {
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        //profile pric assignemnt
        $rand = rand(1, 2); //rand number [1-2]
        if ($rand == 1)
            $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        else if ($rand == 2)
            $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
        
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
        <input type="text" name="reg_fname"  placeholder="First Name" value="<?php
        if (isset($_SESSION['reg_fname'])) {
            echo $_SESSION['reg_fname'];
        }
        ?>" required>
        <br>
        <?php if (in_array("yoru first anme must bwt 2 and 25 characters<br>", $error_array)) echo "yoru first anme must bwt 2 and 25 characters<br>"; ?>

        <input type="text" name="reg_lname"  placeholder="Last Name" value="<?php
        if (isset($_SESSION['reg_lname'])) {
            echo $_SESSION['reg_lname'];
        }
        ?>" required>
        <br>
        <?php if (in_array("yoru last anme must bwt 2 and 25 characters<br>", $error_array)) echo "yoru last anme must bwt 2 and 25 characters<br>"; ?>

        <input type="text" name="reg_email"  placeholder="Email" value="<?php
        if (isset($_SESSION['reg_email'])) {
            echo $_SESSION['reg_email'];
        }
        ?>" required>
        <br>
        <input type="text" name="reg_email2"  placeholder="Confirm Email" value="<?php
        if (isset($_SESSION['reg_email2'])) {
            echo $_SESSION['reg_email2'];
        }
        ?>" required>
        <br>
        <?php if (in_array("email already in use<br>", $error_array)) echo "email already in use<br>";
        else if (in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
        else if (in_array("emails don't match<br>", $error_array)) echo "emails don't match<br>"; ?>

        <input type="text" name="reg_password" value="" placeholder="Password" required>
        <br>
        <input type="text" name="reg_password2" value="" placeholder="Confirm Password" required>
        <br>
        <?php if (in_array("password not match<br>", $error_array)) echo "password not match<br>";
        else if (in_array("your password can only contain english char or numbrs<br>", $error_array)) echo "your password can only contain english char or numbrs<br>";
        else if (in_array("your password len must btw 5 and 30 chars<br>", $error_array)) echo "your password len must btw 5 and 30 chars<br>"; ?>

        <input type="submit" name="register_button" value="Register">
        <br>

    </form>

  </body>
</html>
