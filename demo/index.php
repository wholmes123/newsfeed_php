<?php
include("includes/header.php");
// session_destroy();   // destroy all session everytime after loaded index.php
?>

<!-- first half of body/html tag is in header.php, if loggedIn -->
    <div class="user_details column">
        <a href="#"> <img src="<?php echo $user['profile_pic'];?>" alt=""> </a>
        <div class="user_details_left_right">
            <a href="#">
            <?php
            echo $user['first_name'] . " " . $user['last_name']
            ?>
            </a>
            <br>
            <?php echo "Posts:" . $user['num_posts'] . "<br>";
            echo "Likes:" . $user['num_likes'];
            ?>
        </div>


    </div>

    <div class="main_column column">
        <form class="post_form" action="index.php" method="post">
            <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
            <input type="submit" name="post" id="post_button" value="post">

        </form>

    </div>

    </div>

</body>
</html>
