<?php
$verify_link="https://helleaa.com/verify.php?email=".$to."&token=".$token;
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
   include("email-templates1.php");
   $message = ob_get_contents();
   ob_end_clean();
 
   $sent = mail($to, $subject, $message, $headers);
 
//   if(!$sent){
//      echo "Error: Message not sent. Please try again";
//   }else{
//      echo "Message was sent successfully";
//   }

