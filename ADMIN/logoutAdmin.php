<?php
ob_start();
session_start();
include('Link/config.php');
$sqlUpdate="UPDATE tbladmin SET  OnLine='0' WHERE  ID='".$_SESSION['ADMIN_ID']."' ";
$queryUpdate = $dbh->prepare($sqlUpdate);
$queryUpdate->execute();


$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
unset($_SESSION['ADMIN_LOGGED_IN']); 
unset($_SESSION['ADMIN_USERNAME']); 
unset($_SESSION['ADMIN_ID']); 
unset($_SESSION['ADMIN_ROOT']); 
unset($_SESSION['ADMIN_PROFILE']);
unset($_SESSION['ADMIN_NAME']);



session_destroy(); // destroy session
header("location: login.php"); 
exit;
?>

