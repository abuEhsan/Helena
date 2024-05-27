<?php
require_once __DIR__ . "/../lib/DataSource.php";
$db_handle = new DataSource();
if (! empty($_POST["p_id"])) {
    $memberId = 1;
        $sql = "INSERT INTO tbl_whish_list (product_id, member_id) VALUES (?, ?)";
        $paramType = 'ii';
        $paramValue = array(
            $_POST["p_id"],
            $memberId
        );
        $whishlist_id = $db_handle->insert($sql, $paramType, $paramValue);
        echo $whishlist_id;
    exit();
}
?>