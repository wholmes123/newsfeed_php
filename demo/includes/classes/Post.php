<?php

class Post {
    private $user;
    private $con;

    public function __construct($con, $user) {
        $this->con = $con;
        $this->user_obj = new User($con, $user);
    }

    public function submitPost($body, $user_to) {
        $body = strip_tags($body); //remove html jtag_soft_reset
        $body = mysqli_real_escape_string($this->con, $body);
        $check_empty = preg_replace('/\s+/', '', $body);  // deletes all spaces

        if ($check_empty != "") {

            //current date and times
            $date_added = date("Y-m-d H:i:s");
            // get $username
            $added_by = $this->user_obj->getUsername();

            //if user is not on own profile, user_to is 'none'
            if ($user_to == $added_by) {
                $user_to = "none";
            }


        }

    }

}

 ?>
