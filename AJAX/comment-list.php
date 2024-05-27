<?php
require_once ("../ADMIN/Link/config.php");
$memberId = 1;
$sql = "SELECT\n"

    . "    tbl_comment.*,\n"

    . "    tbl_like_unlike.like_unlike\n"

    . "FROM\n"

    . "    tbl_comment\n"

    . "LEFT JOIN tbl_like_unlike ON tbl_comment.comment_id = tbl_like_unlike.comment_id AND member_id = {$memberId}\n"

    . "ORDER BY\n"

    . "    parent_comment_id ASC,\n"

    . "    comment_id ASC;";

$result = mysqli_query($dbh, $sql);
$record_set = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($record_set, $row);
}
mysqli_free_result($result);

mysqli_close($dbh);
echo json_encode($record_set);
?>