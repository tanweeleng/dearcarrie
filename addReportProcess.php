<?php
include("controllers/templates.php");

$postid = $_POST["postid"];
$userid = $_SESSION["userid"];
$itemid = $_POST["itemid"];
$type = $_POST["type"];
$comment = htmlentities($_POST["desc"], ENT_QUOTES);
//Add to db
$conn = connectToDataBase();

$sql = "INSERT INTO reports (userid, itemid, comment, type)
VALUES ('$userid', '$itemid', '$comment', '$type')";

validateQuery($conn, $sql);

$postID = $conn->insert_id;
$conn->close();
//Re-direct
header("location: post?postID=$postid");
?>
