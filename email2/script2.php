<?php
$token = md5(time());

//            $to =$_GET['cust_email'];
$to = "tariq9829@gmail.com";
//            $BASE_URL='helleaa.com';
//            $subject = 'مرحبا بكم في متجر  هلينا';
//            $text='عزيزي العميل لتفعيل حسابك لدينا يرجى تأكيد العملية من خلال النقر على الرابط الموضح';
            $verify_link="https://helleaa.com/verify.php?email=".$to."&token=".$token;
//            $message = '
//            '.$text.'<br><br>
//
//                <a href="'.$verify_link.'">'.$verify_link.'</a>';
//
//            $headers = "From: Suqiplus@" . $BASE_URL . "\r\n" .
//                   "Reply-To: noreply@" . $BASE_URL . "\r\n" .
//                   "X-Mailer: PHP/" . phpversion() . "\r\n" . 
//                   "MIME-Version: 1.0\r\n" . 
//                   "Content-Type: text/html; charset=ISO-8859-1\r\n";
//        
//        // Sending Email
//        mail($to, $subject, $message, $headers);
        
       // In php 7.2 and newer versions we can use an array to set the headers.
   $headers = array(
    	'MIME-Version' => '1.0',
    	'Content-type' => 'text/html;charset=UTF-8',
    	'From' => 'Helena',
    	'Reply-To' => 'content@helleaa.com'
   );
 
   // Setting the value in the $name variable.
   $name = "متجر هيلينا";
$subject = "اهلا عميلنا المميز .. يرجى تأكيد تسجيل دخولك!";
 $subject = "اهلا عميلنا المميز .. يرجى تأكيد تسجيل دخولك!";
   // Starting output buffer.
   ob_start();
   include("email-templates2.php");
   $message = ob_get_contents();
   ob_end_clean();
 
   $sent = mail($to, $subject, $message, $headers);
 
   if(!$sent){
      echo "Error: Message not sent. Please try again";
   }else{
      echo "Message was sent successfully";
   }
