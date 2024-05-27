<?php

    if (isset($_POST['UPDATE_PROFILE'])) {

        $valid = 1;

        if(empty($_POST['cust_name'])) {
            $valid = 0;
            $error_message .= " حقل الاسم فارغ"."<br>";
        }

        if(empty($_POST['cust_phone'])) {
            $valid = 0;
            $error_message .= "حقل رقم الهاتف فارغ"."<br>";
        }

        if(empty($_POST['cust_address'])) {
            $valid = 0;
            $error_message .= " حقل البريد فارغ"."<br>";
        }




        if($valid == 1) {
            // update data into the database
            $statement = $dbh->prepare("UPDATE tbl_customer SET cust_name=?, cust_cname=?, cust_phone=?, cust_country=? WHERE cust_id=?");
            $statement->execute(array(
                
                        strip_tags($_POST['cust_name']),
                        strip_tags($_POST['cust_cname']),
                        strip_tags($_POST['cust_phone']),
                        $_SESSION['customer']['cust_id']
                
                    ));  

            
            $success_message = "تم تحديث بياناتك الشخصية بنجاح.";
            $_SESSION['customer']['cust_name'] = $_POST['cust_name'];
            $_SESSION['customer']['cust_cname'] = $_POST['cust_cname'];
            $_SESSION['customer']['cust_phone'] = $_POST['cust_phone'];

        }
    }

?>

   <form action="UpdateBill.php" method="post" >
     <?php
                    if($error_message != '') {
                        echo "<div class='alert alert-success alert-dismissible fade show' >".$error_message."</div>";
                    }
                    if($success_message != '') {
                        echo "<div class='alert alert-danger alert-dismissible fade show' >".$success_message."</div>";
                    }
       ?>
                               
       <div id="anotherShipping" class="collapse mt-3" data-parent="#anotherShipping">
           <div class="row">
               <div class="col-lg-6">
                   <div class="default-form-box">
                       <label>إسم الشخصي <span>*</span></label>
                       <input type="text" name="cust_name"  id="name" placeholder="إسمك" value="<?php echo $_SESSION['customer']['cust_name']; ?>" required>
                   </div>
               </div>
               <div class="col-12">
                   <div class="default-form-box">
                       <label>اسم النشاط </label>
                       <input type="text" id="name" placeholder="اسم النشاط" name="custcust_cname_b_cname" value="<?php echo $_SESSION['customer']['cust_cname']; ?>" required >
                   </div>
               </div>
               <div class="col-12">
                   <div class="default-form-box">
                       <label> بريدك الإلكتروني <span>*</span></label>
                       <input type="email" id="name" placeholder="example@mail.com" name="cust_email" value="<?php echo $_SESSION['customer']['cust_email']; ?>"  required>
                   </div>
               </div>
              <div class="col-12">
               <div class="default-form-box">
                       <label>  رقم هاتفك <span>*</span></label>
                       <input type="text" id="name" placeholder="05xxxxxxx" name="cust_phone" value="<?php echo $_SESSION['customer']['cust_phone']; ?>" required >
                   </div>
               </div>
                                    
               <div class="order_button pt-3">
                    <button class="btn btn-md btn-black-default-hover" type="submit" name="UPDATE_PROFILE">تحديث الفاتورة</button>
               </div>
           </div>
       </div>
                        
   </form><!-- end form -->
