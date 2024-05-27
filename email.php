<?php

         $to ='tariqbuss1@gmail.com';
        include("EMAIL/Verify-Email-Script.php");
        
        

        if(!$sent){
                $success_message=" المعذرة ... إن لم يتم ارسال رسالة تحقق لبريدك الالكتروني يرجى إعادة تسجيل بياناتك مجدد بعد 30 ثانية  ";
                echo "<script>alert('".$success_message."')</script>";
                echo "<script type='text/javascript'> document.location = 'Register.php'; </script>";
           }else{
            
                $success_message=" المعذرة ... إن لم يتم ارسال رسالة تحقق لربيدك يرجى إعادة تسجيل بياناتك مجدد بعد 30 ثانية  ";
                $success_message=" تم تسجيل بياناتك بنجاح ... الرجاء التحقق من بريدك الالكتروني لتأكيد تسجيل حسابك!";
                echo "<script>alert('".$success_message."')</script>"; 
                echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
                unset($_POST['cust_name']);
                unset($_POST['cust_cname']);
                unset($_POST['cust_email']);
                unset($_POST['cust_phone']);
                unset($_POST['cust_address']);
            
           }













