<?php
require_once ("../ADMIN/Link/config.php");
//$memberId = $_SESSION['customer']['cust_id'];
$memberId=1;
$commentId = $_POST['comment_id'];
$totalLikes = "No ";
$likeQuery = "SELECT sum(like_unlike) AS likesCount FROM tbl_like_unlike WHERE member_id ={$memberId} AND comment_id={$commentId}";
$resultLikeQuery = mysqli_query($conn,$likeQuery);
$fetchLikes = mysqli_fetch_array($resultLikeQuery,MYSQLI_ASSOC);
if(isset($fetchLikes['likesCount'])) {
    $totalLikes = $fetchLikes['likesCount'];
}

echo $totalLikes;


?>