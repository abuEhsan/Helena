<?php
ob_start();
session_start();
include("../../ADMIN/Link/config.php");
include("../../ADMIN/Link/functions.php");

if( !isset($_REQUEST['msg']) ) {
	if(empty($_POST['transaction_info']) || strlen($_POST['transaction_info']) < 10) {
		header('location: ../../Checkout.php');
	} else {
		$payment_date = date('Y-m-d H:i:s');
	    $payment_id = time();

	    $statement = $dbh->prepare("INSERT INTO tblpayment (   
	                            customer_id,
	                            customer_name,
	                            customer_email,
	                            payment_date,
	                            txnid, 
	                            paid_amount,
	                            card_number,
	                            card_cvv,
	                            card_month,
	                            card_year,
	                            bank_transaction_info,
	                            payment_method,
	                            payment_status,
	                            shipping_status,
	                            payment_id
	                        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	    $statement->execute(array(
	                            $_SESSION['customer']['cust_id'],
	                            $_SESSION['customer']['cust_name'],
	                            $_SESSION['customer']['cust_email'],
	                            $payment_date,
	                            '',
	                            $_POST['amount'],
	                            '', 
	                            '',
	                            '', 
	                            '',
	                            $_POST['transaction_info'],
	                            'Bank Deposit',
	                            'Pending',
	                            'Pending',
	                            $payment_id
	                        ));
 
	    $i=0;
	    foreach($_SESSION['cart_p_id'] as $key => $value) 
	    {
	        $i++;
	        $arr_cart_p_id[$i] = $value;
	    }

	    $i=0;
	    foreach($_SESSION['cart_p_name'] as $key => $value) 
	    {
	        $i++;
	        $arr_cart_p_name[$i] = $value;
	    }



	    $i=0;
	    foreach($_SESSION['cart_p_qty'] as $key => $value) 
	    {
	        $i++;
	        $arr_cart_p_qty[$i] = $value;
	    }

	    $i=0;
	    foreach($_SESSION['cart_p_current_price'] as $key => $value) 
	    {
	        $i++;
	        $arr_cart_p_current_price[$i] = $value;
	    }

	    $i=0;
	    $statement = $dbh->prepare("SELECT * FROM tblproducts");
	    $statement->execute();
	    $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	    foreach ($result as $row) {
	    	$i++;
	    	$arr_p_id[$i] = $row['id'];
	    	$arr_p_qty[$i] = $row['qualty'];
	    }

	    for($i=1;$i<=count($arr_cart_p_name);$i++) {
	        $statement = $dbh->prepare("INSERT INTO tblorder (
	                        product_id,
	                        product_name,
	                        size, 
	                        color,
	                        quantity, 
	                        unit_price, 
	                        payment_id
	                        ) 
	                        VALUES (?,?,?,?,?,?,?)");
	        $sql = $statement->execute(array(
	                        $arr_cart_p_id[$i],
	                        $arr_cart_p_name[$i],
	                        $arr_cart_size_name[$i],
	                        $arr_cart_color_name[$i],
	                        $arr_cart_p_qty[$i],
	                        $arr_cart_p_current_price[$i],
	                        $payment_id
	                    ));

	        // Update the stock
            for($j=1;$j<=count($arr_p_id);$j++)
            {
                if($arr_p_id[$j] == $arr_cart_p_id[$i]) 
                {
                    $current_qty = $arr_p_qty[$j];
                    break;
                }
            }
            $final_quantity = $current_qty - $arr_cart_p_qty[$i];
            $statement = $dbh->prepare("UPDATE tblproducts SET qualty=? WHERE id=?");
            $statement->execute(array($final_quantity,$arr_cart_p_id[$i]));
            
	    }
	    unset($_SESSION['cart_p_id']);
	    unset($_SESSION['cart_p_qty']);
	    unset($_SESSION['cart_p_current_price']);
	    unset($_SESSION['cart_p_name']);
	    unset($_SESSION['cart_p_featured_photo']);
        unset($_SESSION['couter_items_adds']);
	    header('location: ../../payment_success.php');
	}
}
?>