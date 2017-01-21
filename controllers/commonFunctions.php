<?php
/***************** SESSION FUNCTIONS *********************/

// return true if user is logged in
function checkLogin() {
	if(isset($_SESSION["role"])) {
		return false;
	}
	else {
		return true;
	}
}

function redirectNonUsers() {
	if (checkLogin()) {
		echo "<script type='text/javascript'>window.top.location='/fyp/login';</script>";
		exit;
	}
}

function checkRole($userRole, $role) {
	if($userRole != $role) {
		return false;
	}
	else {
		return true;
	}
}

function goBackIfNotEqual($currentUser, $userID) {
	if($currentUser != $userID) {
		echo "<script type='text/javascript'>history.go(-1);</script>";
		exit;
	}
}

function redirectToLogin($userRole, $role) {
	if($userRole != $role) {
		echo "<script type='text/javascript'>window.top.location='/fyp/login';</script>";
		exit;
	}
}

/***************** DB INITIALIZATION *********************/
function connectToDataBase() {
	$theLineToDatabase =  mysqli_connect("localhost","root","root","dearcarrie");
	//$theLineToDatabase =  mysqli_connect("localhost","tjljess60","123456","dearcarrie");

	if(!$theLineToDatabase) {
		header("location: error.php?msg=Database connection first error");
		exit();
	}
	else {
	  return $theLineToDatabase;
	}
}

/***************** QUERY FUNCTIONS *********************/
function getUserIDByEmail ($email) {
	$conn = connectToDataBase();

	$sql = "SELECT * FROM users WHERE email = '$email'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();
	return $value["id"];
}

/***************** QUICK CHECKS *********************/
//return true if empty
function ifEmpty($var) {
	if (empty($var)) {
    return true;
	}
	else {
		return false;
	}
}

function validateQuery($conn, $sql){
	if ($conn->query($sql) === FALSE) {
		header("location: error.php?msg=validate query error");
		exit();
	}
}

function getPostByID($id) {
	$conn = connectToDataBase();

	$sql = "SELECT * FROM posts WHERE id = '$id'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value;
}


function getUserByID($id) {
	$conn = connectToDataBase();

	$sql = "SELECT * FROM users WHERE id = '$id'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value;
}

function getTopicByID($id) {
	$conn = connectToDataBase();

	$sql = "SELECT * FROM topics WHERE id = '$id'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value;
}

function getCommentByID($id) {
	$conn = connectToDataBase();

	$sql = "SELECT *
					FROM comments c
					INNER JOIN users u ON c.userid = u.id
					WHERE  c.id = '$id'
					ORDER BY c.id DESC, u.role ASC ";

	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value;
}

function displayAllPost() {
	$conn = connectToDataBase();

	$sql = "SELECT * FROM posts WHERE published = 1 ORDER BY id DESC";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function displayAllPostIndex() {
	$conn = connectToDataBase();

	$limit = 20; //limit for posts loaded
	$page = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //get current page for scroll
	//get current starting point of records
	$start = (($page-1) * $limit);

	$sql = "SELECT * FROM posts WHERE published = 1 ORDER BY id DESC LIMIT $start, $limit"; //added $start and $limit
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 //showErrorMessage("No posts found");
		exit();
	}
	$conn->close();
	return $resArr;
}

function suggestedPost() {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM posts WHERE published = 1 ORDER BY id DESC LIMIT 3";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function displayAllTopicsOrderByTitleAsc() {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM topics ORDER BY title ASC";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No topics found");
	}
	$conn->close();
	return $resArr;
}


function displayAllPostByUserID($id) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM posts WHERE userid ='$id' AND published = 1 ORDER BY id DESC ";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function displayAllTopics() {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM topics ORDER BY id DESC";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function displayAllUsers() {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM users";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function getAllCommentsByPostID($id) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM comments WHERE postid = $id";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 //showErrorMessage("No comments found");
	}
	$conn->close();
	return $resArr;
}

function getAllTopicsByPostID($id) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM curation WHERE postid = $id";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function showErrorMessage($msg) {
	header("Location: error.php?msg=$msg");
}

function countPostByUserID($id) {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM posts WHERE userid='$id' AND published = 1";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function searchPost($keyword) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM posts WHERE (title LIKE '%$keyword%' OR id IN (SELECT postid FROM topics INNER JOIN curation WHERE title lIKE '%$keyword%' AND published = 1 AND topicid = id)) AND published = 1";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function getCountPosts($keyword) { //for Search Filter Post
	$conn = connectToDataBase();
	$sql = "SELECT * FROM posts WHERE title LIKE '%$keyword%' AND published = 1";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 //showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function getCountTopics($keyword) { //for Search Filter Topic
	$conn = connectToDataBase();
	$sql = "SELECT * FROM posts p WHERE id IN (SELECT postid FROM topics INNER JOIN curation WHERE title lIKE '%$keyword%' AND published = 1 AND topicid = id) AND published = 1";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 //showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function searchPostByDate($keyword) {
	 $conn = connectToDataBase();
	 $sql = "SELECT * FROM posts WHERE timestamp lIKE '%$keyword%' AND published = 1";
	 $result = $conn->query($sql);
	 $resArr = array();

	 if ($result->num_rows > 0) {
	   // output data of each row
	   while($row = $result->fetch_assoc()) {
	   		$resArr[] = $row;
	   }
	 } else {
	   	showErrorMessage("No posts found");
	 }
	 $conn->close();
	 return $resArr;
}

function searchTopic($keyword) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM topics WHERE title lIKE '%$keyword%' AND published = 1";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No topics found");
	}
	$conn->close();
	return $resArr;
}



//for uploading of imageSizefunction uploadImage($imageName, $imageType, $imageSize, $imageTmpName, $imageError){
//returns string finalImageName
function uploadImage($imageName, $imageType, $imageSize, $imageTmpName, $imageError, $path) {
	//mime = multipurpose internet mail extensions
	$imgMimes = Array( 'image/jpeg', 'image/gif', 'image/pjpeg', 'image/png', 'image/bmp', 'image/jpg', 'image/svg+xml');

	//if( in_array($imageType, $imgMimes)){
	if($check !== false) {

				if($imageError == 0 && $imageSize <= (1024*1024)) {
					$randomNumber = rand(100, 10000000);
					$finalImageName = "images/".$path."/".$randomNumber."_".$imageName;

					if(move_uploaded_file($imageTmpName, $finalImageName)) {

						return $finalImageName;
					}//end of if (move uploaded file)

					else {
						echo "Unable to insert the Image due to image error";
						//header("location: error.php?msg=Unable to insert the Image due to image error");
						exit();
					}//end of else
				}// end of if (image error & size)

				else {
					header("location: error.php?msg=Image size is too large/ There is an error in the image");
					exit();
				}
		}//end of if for image validation

		/*else {
			header("location: error.php?msg=Please insert an image type.");
			exit();
		}*/
}

function displayPubStatus($status) {
	if ($status) {
		return "Published";
	}
	else {
		return "Unpublished";
	}
}

function displayFeaturedTopics() {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM topics WHERE type = 'featured' ORDER BY order_num";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	}

	$conn->close();
	return $resArr;
}

function displayCuratedTopics() {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM topics WHERE type = 'curated' ORDER BY order_num";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	}
	$conn->close();
	return $resArr;
}

function displayMainTopics() {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM topics WHERE type = 'main' ORDER BY order_num";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	}
	$conn->close();
	return $resArr;
}

function getPostsByTopicID($topicid) {
	$conn = connectToDataBase();
	$sql = "SELECT *
					FROM posts p
					INNER JOIN curation c ON p.id = c.postid
					WHERE published = 1 AND c.topicid = '$topicid'
					ORDER BY p.id DESC";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

//make sure posts are published
function countPostByTopicID($topicid) {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total
					FROM curation c
					INNER JOIN posts p ON c.postid = p.id
					WHERE c.topicid='$topicid' AND p.published = 1";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function countFollowersByTopicID($topicid) {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total
					FROM topic_follow
					WHERE topicid = '$topicid'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function followTopic ($userid, $topicid) {
	$conn = connectToDataBase();
	$sql = "INSERT INTO topic_follow (userid, topicid) VALUES ('$userid', '$topicid')";
	validateQuery($conn, $sql);
}

function unfollowTopic ($userid, $topicid) {
	$conn = connectToDataBase();
	$sql = "DELETE FROM topic_follow WHERE userid = '$userid' AND topicid = '$topicid'";
	validateQuery($conn, $sql);
}

function isFollowingTopic ($userid, $topicid) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM topic_follow WHERE userid='$userid' AND topicid='$topicid' LIMIT 1";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result) > 0) {
			return true; //is following
	} else {
		return false;
	}
}

function isFollowingPost ($userid, $postid) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM post_follow WHERE userid='$userid' AND postid='$postid' LIMIT 1";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result) > 0) {
			return true; //is following
	} else {
		return false;
	}
}

function followPost ($userid, $postid) {
	$conn = connectToDataBase();
	$sql = "INSERT INTO post_follow (userid, postid) VALUES ('$userid', '$postid')";
	validateQuery($conn, $sql);
}

function unfollowPost ($userid, $postid) {
	$conn = connectToDataBase();
	$sql = "DELETE FROM post_follow WHERE userid = '$userid' AND postid = '$postid'";
	validateQuery($conn, $sql);
}

function followUser ($currentuser, $userid) {
	$conn = connectToDataBase();
	$sql = "INSERT INTO user_follow (userid, follower) VALUES ('$userid', '$currentuser')";
	validateQuery($conn, $sql);

	//get userid email
	$recipientEmail = getUserNameByID($userid);
	//send email
  $subject = "You have a new follower!";
  // Get HTML contents from file
  $htmlContent = file_get_contents("email/new_follower.php");
  $htmlContent = str_replace("{name}", $_SESSION["name"], $htmlContent);

  // Set content-type for sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // Additional headers
  $headers .= 'From: Dear Carrie<jess_tjl@hotmail.com>' . "\r\n";
  //$headers .= 'Cc: codexworld@gmail.com' . "\r\n";
  // Send email
  if(mail($recipientEmail["email"],$subject,$htmlContent,$headers)):
    $successMsg = 'Email has sent successfully.';
  else:
    $errorMsg = 'Some problem occurred, please try again.';
  endif;

}

function unfollowUser ($currentuser, $userid) {
	$conn = connectToDataBase();
	$sql = "DELETE FROM user_follow WHERE follower = '$currentuser' AND userid = '$userid'";
	validateQuery($conn, $sql);
}

function isFollowingUser ($currentuser, $userid) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM user_follow WHERE userid='$userid' AND follower='$currentuser' LIMIT 1";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result) > 0) {
			return true; //is following
	} else {
		return false;
	}
}

function countFollowersByUserID($id) {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM user_follow WHERE userid='$id'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function countFollowingByUserID($userid) {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM user_follow WHERE follower='$userid'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function countTopicsFollowedByUserID($id) {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM topic_follow WHERE userid='$id'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function getTopicsFollowedByUserID($id) {
	$conn = connectToDataBase();

	$sql = "SELECT *
					FROM topic_follow f
					INNER JOIN topics t ON f.topicid = t.id
					WHERE f.userid = '$id'";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No topics found");
	}
	$conn->close();
	return $resArr;
}

//to be improved
function displayTrendingPosts() {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM posts WHERE published = 1 ORDER BY id DESC LIMIT 4";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function likePost ($userid, $postid) {
	$conn = connectToDataBase();
	$sql = "INSERT INTO post_like (userid, postid) VALUES ('$userid', '$postid')";
	validateQuery($conn, $sql);
}

function unlikePost ($userid, $postid) {
	$conn = connectToDataBase();
	$sql = "DELETE FROM post_like WHERE userid = '$userid' AND postid = '$postid'";
	validateQuery($conn, $sql);
}

function hasLikedPost ($userid, $postid) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM post_like WHERE userid='$userid' AND postid='$postid' LIMIT 1";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result) > 0) {
			return true; //is following
	} else {
		return false;
	}
}

function countPostLikes($id) {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM post_like WHERE postid='$id'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function countCommentsByPostID($id) {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM comments WHERE postid='$id'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function hasLikedComment ($userid, $commentid) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM comment_like WHERE userid='$userid' AND commentid='$commentid' LIMIT 1";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result) > 0) {
			return true; //is following
	} else {
		return false;
	}
}

function countCommentsLikes($id) {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM comment_like WHERE commentid='$id'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function likeComment ($userid, $commentid) {
	$conn = connectToDataBase();
	$sql = "INSERT INTO comment_like (userid, commentid) VALUES ('$userid', '$commentid')";
	validateQuery($conn, $sql);
}

function unlikeComment ($userid, $commentid) {
	$conn = connectToDataBase();
	$sql = "DELETE FROM comment_like WHERE userid = '$userid' AND commentid = '$commentid'";
	validateQuery($conn, $sql);
}

function getPostTopics ($postid) {
	$conn = connectToDataBase();
	$sql = "SELECT c.topicid AS topicid, t.title AS title
					FROM topics t
					INNER JOIN curation c on c.topicid = t.id
					WHERE c.postid = '$postid'
					";

	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	}

	$conn->close();
	return $resArr;
}

function getPostsLikedByUser($userid) {
	$conn = connectToDataBase();
	$sql = "SELECT *
					FROM posts p
					INNER JOIN post_like l ON p.id = l.postid
					WHERE l.userid = '$userid'
				 ";

	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$resArr[] = $row;
		}
	}

	$conn->close();
	return $resArr;
}

function getCommentsByUserID($userid) {
	$conn = connectToDataBase();
	$sql = "SELECT *
					FROM comments
					WHERE userid='$userid'
				 ";

	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$resArr[] = $row;
		}
	}

	$conn->close();
	return $resArr;
}

function getFollowing($userid) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM user_follow WHERE follower = '$userid'";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$resArr[] = $row;
		}
	}

	$conn->close();
	return $resArr;
}

function getFollowers($userid) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM user_follow WHERE userid = '$userid'";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$resArr[] = $row;
		}
	}

	$conn->close();
	return $resArr;
}

function getNotificationsByUserID($userid) {
	$currUser = $_SESSION["userid"];
	$conn = connectToDataBase();
	$sql = "SELECT p.userid as to_user, n.item, n.from_user, n.type, n.seen
					FROM notifications n
					INNER JOIN posts p ON n.item = p.id
					WHERE n.type = 'post_follow' AND p.userid='$userid' AND p.userid != '$currUser'
					UNION
					SELECT u.id as to_user, n.item, n.from_user, n.type, n.seen
					FROM notifications n
					INNER JOIN users u ON n.item = u.id
					WHERE n.type = 'user_follow' AND u.id='$userid'
					UNION
					SELECT p.userid as to_user, n.item, n.from_user, n.type, n.seen
					FROM notifications n
					INNER JOIN posts p ON n.item = p.id
					WHERE n.type = 'post_like' AND p.userid='$userid' AND p.userid != '$currUser'
					UNION
					SELECT p.userid as to_user, n.item, n.from_user, n.type, n.seen
					FROM notifications n
					INNER JOIN comments c ON n.item = c.id
					INNER JOIN posts p ON p.id = c.postid
					WHERE n.type = 'new_comment' AND p.userid='$userid' AND p.userid != '$currUser'
					UNION
					SELECT c.userid as to_user, n.item, n.from_user, n.type, n.seen
					FROM notifications n
					INNER JOIN comments c ON n.item = c.id
					WHERE n.type = 'comment_like' AND c.userid='$userid' AND n.from_user != '$currUser'
				";

	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$resArr[] = $row;
		}
	}

	$conn->close();
	return $resArr;
}

function getUserNameByID($id) {
	$conn = connectToDataBase();

	$sql = "SELECT * FROM users WHERE id = '$id'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();
	return $value;
}

function changeNotificationSeen($item, $type, $from_user) {
	$conn = connectToDataBase();

	$sql = "UPDATE notifications SET seen=1 WHERE item='$item' AND type='$type' AND from_user='$from_user'";
	validateQuery($conn, $sql);
}

function getUnseenNotificationCount($userid) {
	$currUser = $_SESSION["userid"];
	$conn = connectToDataBase();
	$sql = "SELECT p.userid as to_user, n.item, n.from_user, n.type, n.seen
					FROM notifications n
					INNER JOIN posts p ON n.item = p.id
					WHERE n.type = 'post_follow' AND p.userid='$userid' AND n.seen=0  AND p.userid != '$currUser'
					UNION
					SELECT u.id as to_user, n.item, n.from_user, n.type, n.seen
					FROM notifications n
					INNER JOIN users u ON n.item = u.id
					WHERE n.type = 'user_follow' AND u.id='$userid' AND n.seen=0
					UNION
					SELECT p.userid as to_user, n.item, n.from_user, n.type, n.seen
					FROM notifications n
					INNER JOIN posts p ON n.item = p.id
					WHERE n.type = 'post_like' AND p.userid='$userid' AND n.seen=0 AND p.userid != '$currUser'
					UNION
					SELECT p.userid as to_user, n.item, n.from_user, n.type, n.seen
					FROM notifications n
					INNER JOIN comments c ON n.item = c.id
					INNER JOIN posts p ON p.id = c.postid
					WHERE n.type = 'new_comment' AND p.userid='$userid' AND n.seen=0 AND p.userid != '$currUser'
					UNION
					SELECT c.userid as to_user, n.item, n.from_user, n.type, n.seen
					FROM notifications n
					INNER JOIN comments c ON n.item = c.id
					WHERE n.type = 'comment_like' AND c.userid='$userid' AND n.seen=0 AND n.from_user != '$currUser'
				";

	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$resArr[] = $row;
		}
	}

	$conn->close();
	return $resArr;
}

function calculateDays($date) {
	return date('d M y',strtotime($date));
}

function displayAllReports() {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM reports ORDER BY id DESC, seen DESC";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function getReportByID ($id) {
	$conn = connectToDataBase();

	$sql = "SELECT * FROM reports WHERE id = '$id'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();
	return $value;
}

function getAllReportsByPostID($postid) {
	$conn = connectToDataBase();
	$sql = "SELECT * FROM reports WHERE itemid = '$postid' AND type = 'post'";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function countReportsByPostID($id) {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM reports WHERE itemid='$id' AND type = 'post'";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function countTotalUsers() {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM users";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function countTotalPosts() {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM posts";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function countTotalComments() {
	$conn = connectToDataBase();
	$sql = "SELECT COUNT(*) AS total FROM comments";
	$result = $conn->query($sql);
	$value = $result->fetch_assoc();

	$conn->close();
	return $value["total"];
}

function displayAllPostOrderbyViews() {
	$conn = connectToDataBase();

	$sql = "SELECT * FROM posts WHERE published = 1 ORDER BY views DESC";
	$result = $conn->query($sql);
	$resArr = array();

	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 $resArr[] = $row;
		 }
	} else {
		 showErrorMessage("No posts found");
	}
	$conn->close();
	return $resArr;
}

function sendCommentEmail($userid, $postid, $comment) {
	$recipientID = getPostByID($postid);
	$recipientEmail = getUserNameByID($recipientID["userid"]);

	if ($recipientEmail["id"] != $_SESSION["userid"]) {
		//get recipient email

	  $subject = "You have a new comment on your post";
	  // Get HTML contents from file
	  $htmlContent = file_get_contents("email/new_comment.php");
	  $htmlContent = str_replace("{name}", $_SESSION["name"], $htmlContent);
	  $htmlContent = str_replace("{comment}", $comment, $htmlContent);
	  $htmlContent = str_replace("{url}", "http://www.jessdesigntan.com/fyp/post?postID=".$postid, $htmlContent);

	  // Set content-type for sending HTML email
	  $headers = "MIME-Version: 1.0" . "\r\n";
	  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	  // Additional headers
	  $headers .= 'From: Dear Carrie<jess_tjl@hotmail.com>' . "\r\n";
	  //$headers .= 'Cc: codexworld@gmail.com' . "\r\n";
	  // Send email
	  if(mail($recipientEmail["email"],$subject,$htmlContent,$headers)):
	    $successMsg = 'Email has sent successfully.';
	  else:
	    $errorMsg = 'Some problem occurred, please try again.';
	  endif;
	}
}

?>
