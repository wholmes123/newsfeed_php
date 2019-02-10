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

            //insert post
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
            $returned_id = mysqli_insert_id($this->con);   //make auto incr id
            //Insert notification

			//Update post count for user
            $num_posts = $this->user_obj->getNumPosts();
			$num_posts++;
			$update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");
        }
    }

    public function loadPostsFriends() {

        $str = ""; //String to return
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

        while($row = mysqli_fetch_array($data_query)) {
			$id = $row['id'];
			$body = $row['body'];
			$added_by = $row['added_by'];
			$date_time = $row['date_added'];

			//Prepare user_to string so it can be included even if not posted to a user
			if($row['user_to'] == "none") {
				$user_to = "";
			}
			else {
				$user_to_obj = new User($con, $row['user_to']);
				$user_to_name = $user_to_obj->getFirstAndLastName();
				$user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>";  //str, used in later for html
			}

			//Check if user who posted, has their account closed (not show post to user whose accout is closed)
			$added_by_obj = new User($this->con, $added_by);
			if($added_by_obj->isClosed()) {
				continue;
			}

            $user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
			$user_row = mysqli_fetch_array($user_details_query);
            $first_name = $user_row['first_name'];
			$last_name = $user_row['last_name'];
			$profile_pic = $user_row['profile_pic'];

            //Timeframe
			$date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_time); //Time of post
			$end_date = new DateTime($date_time_now); //Current time
			$interval = $start_date->diff($end_date); //Difference between dates
            if($interval->y >= 1) {
				if($interval == 1)
					$time_message = $interval->y . " year ago"; // 1 year ago
				else
					$time_message = $interval->y . " years ago"; // >=2 year ago
			}
			else if ($interval-> m >= 1) {    // less than a year, but more than 1 month ago,
				if($interval->d == 0) {     // handler days
					$days = " ago";
				}
				else if($interval->d == 1) {
					$days = $interval->d . " day ago";
				}
				else {
					$days = $interval->d . " days ago";
				}

				if($interval->m == 1) {     // handle months
					$time_message = $interval->m . " month". $days;
				}
				else {
					$time_message = $interval->m . " months". $days;
				}

			}
            else if($interval->d >= 1) {    //less than a month ago
				if($interval->d == 1) {
					$time_message = "Yesterday";
				}
				else {
					$time_message = $interval->d . " days ago";
				}
			}
            else if($interval->i >= 1) {   //less than a day ago
				if($interval->i == 1) {
					$time_message = $interval->i . " minute ago";
				}
				else {
					$time_message = $interval->i . " minutes ago";
				}
			}
			else {                    //less than a minut ago
				if($interval->s < 30) {
					$time_message = "Just now";
				}
				else {
					$time_message = $interval->s . " seconds ago";
				}
			}
            // assemble final post html
            $str .= "<div class='status_post'>
						<div class='post_profile_pic'>
							<img src='$profile_pic' width='50'>
						</div>

						<div class='posted_by' style='color:#ACACAC;'>
							<a href='$added_by'> $first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
						</div>
						<div id='post_body'>
							$body
							<br>
						</div>

					</div>
					<hr>";

        }  //End while loop
        // if($count > $limit)
    	// 	$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
    	// 				<input type='hidden' class='noMorePosts' value='false'>";
    	// else
    	// 	$str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>";

        echo $str;
    }
}


 ?>
