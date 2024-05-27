<?php
require_once('Links/Setting.php');
if(!isset($_REQUEST['PID'])) {
    header('location: index.php');
    exit;
} else {
    
   // Check the id is valid or not
    $statement = $dbh->prepare("SELECT * FROM tblproducts WHERE id=?");
    $statement->execute(array($_REQUEST['PID']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if( $total == 0 ) {
         header('location: index.php');
        exit;
    }else{
         
         //Inaliztion Data
        foreach($result as $row) {
            $p_name = $row['Name'];
            $price = $row['price'];
            $p_qty = $row['qualty'];
            $p_featured_photo = $row['Icon'];
            $p_total_view = $row['totalview'];
            $p_is_active = $row['Status'];
            $ecat_id = $row['CategoryId'];
            $curr_id = $row['CurrencyId'];
         }

        
        
        
            // getting the currect stock of this product
            if(isset($_SESSION['cart_p_id']))
               {
                $arr_cart_p_id = array();
                $arr_cart_size_id = array();
                $arr_cart_color_id = array();
                $arr_cart_p_qty = array();
                $arr_cart_p_current_price = array();


                $i=0;
                foreach($_SESSION['cart_p_id'] as $key => $value) 
                {
                    $i++;
                    $arr_cart_p_id[$i] = $value;
                }


                for($i=1;$i<=count($arr_cart_p_id);$i++) {
                    if( ($arr_cart_p_id[$i]==$_REQUEST['PID'])) {
                        $added = 1;
                        break;
                    }
                }


                if($added == 1) {
//                   $error_message1 = 'This product is already added to the shopping cart.';
                  $error_message1 = 'هذا المنتج مضاف مسبقا في السلة';

                } else {

                    $i=0;
                    foreach($_SESSION['cart_p_id'] as $key => $res) 
                    {
                        $i++;
                    }

                    $new_key = $i+1;
                    $_SESSION['cart_p_id'][$new_key] = $_REQUEST['PID'];
                    $_SESSION['cart_p_qty'][$new_key] = 1;
                    $_SESSION['cart_p_current_price'][$new_key] = $price;
                    $_SESSION['cart_p_name'][$new_key] = $p_name;
                    $_SESSION['cart_p_featured_photo'][$new_key] = $p_featured_photo;
                    $_SESSION['couter_items_adds']+=1;
//                    $success_message1 = 'Product is added to the cart successfully!';
                    $success_message1 = 'تم إضافة المنتج في السلة بنجاح.';
                    
                }






            }else{

                    $_SESSION['cart_p_id'][1] = $_REQUEST['PID'];
                    $_SESSION['cart_p_qty'][1] = 1;
                    $_SESSION['cart_p_current_price'][1] = $price;
                    $_SESSION['cart_p_name'][1] = $p_name;
                    $_SESSION['cart_p_featured_photo'][1] = $p_featured_photo;
                    $_SESSION['couter_items_adds']+=1;
//                    $success_message1 = 'Product is added to the cart successfully!';
                    $success_message1 = 'تم إضافة المنتج في السلة بنجاح.';
                
                
              }

            if($error_message1 != '') {
                echo "<script>alert('".$error_message1."')</script>";
                 header('location: index.php');
                exit();
            }
            if($success_message1 != '') {
                echo "<script>alert('".$success_message1."')</script>";
//                header('location: product.php?id='.$_REQUEST['id']);
//                header('location: index.php?PID='.$_REQUEST['PID']);
//                exit();
                echo "<script type='text/javascript'> document.location = 'index.php?PID={$_REQUEST['PID']}'; </script>";
            }
        
    }
    

}
        
  