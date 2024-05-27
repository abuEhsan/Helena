<?php
include('Link/error-reporting.php');
include('Link/config.php');
include('Link/Setting.php');
if( !isset($_REQUEST['id']) || !isset($_REQUEST['task']) ) {
	header('logoutAdmin.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $dbh->prepare("SELECT * FROM tblpayment WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logoutAdmin.php');
		exit;
	}
}
?>

<?php
	$statement = $dbh->prepare("UPDATE tblpayment SET shipping_status=? WHERE id=?");
	$statement->execute(array($_REQUEST['task'],$_REQUEST['id']));

//	header('location: Manage-Pleading-Adds.php');
    echo "<script type='text/javascript'> document.location = 'Manage-Orders-Shopping.php'; </script>";

