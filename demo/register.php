<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Welcom to Swirlfeed!</title>
  </head>
  <body>

    <form action="register.php" method="POST">
        <input type="email" name="log_email" placeholder="Email address" value="<?php
        if (isset($_SESSION['log_email'])) {
            echo $_SESSION['log_email'];
        }
        ?>" required>
        <br>
        <input type="password" name="log_password" placeholder="Password">
        <br>
        <input type="submit" name="login_button" value="login">

        <?php if(in_array("Email or password was incorrect<br>", $error_array)) echo "Email or password was incorrect"; ?>

    </form>
    <br>

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

        <?php if (in_array("<span style='color:#14C800'> You're all set! Goahead and login </span> <br>", $error_array)) echo "<span style='color:#14C800'> You're all set! Goahead and login </span> <br>"; ?>

    </form>

  </body>
</html>
