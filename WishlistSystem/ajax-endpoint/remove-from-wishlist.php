<?php
require_once __DIR__ . "/../lib/DataSource.php";
$db_handle = new DataSource();
if (! empty($_POST["p_id"])) {
    $memberId = 1;
    $query = "DELETE FROM tbl_whish_list WHERE product_id = ? AND member_id = ?";
    $paramType = 'ii';
    $paramValue = array(
        $_POST["p_id"],
        $memberId
    );
    $affectedRows = $db_handle->delete($query, $paramType, $paramValue);
    echo $affectedRows;
}
exit();
