<?php
include('config.php');
// fetching admin email where mail will send

//$sql ="SELECT emailId from tblemail";
//$query = $dbh -> prepare($sql);
//$query->execute();
//$results=$query->fetchAll(PDO::FETCH_OBJ);
//if($query->rowCount() > 0):
//foreach($results as $result):
//$adminemail=$result->emailId;
//endforeach;
//endif;



if(isset($_POST['submit']))
{
    // getting Post values	
    $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $phoneno=filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT); 
    $email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject=filter_var($_POST['subject'],FILTER_SANITIZE_STRING);
    $message=filter_var($_POST['message'],FILTER_SANITIZE_STRING);
    $uip = $_SERVER ['REMOTE_ADDR'];
    $isread=0;
    
    
    // Insert quaery
    $sql="INSERT INTO  tblcontactdata(FullName,PhoneNumber,EmailId,Subject,Message,UserIp,Is_Read) VALUES(:name,:phone,:email,:subject,:message,:uip,:isread)";
    $query = $dbh->prepare($sql);
    // Bind parameters
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':phone',$phoneno,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':subject',$subject,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->bindParam(':uip',$uip,PDO::PARAM_STR);
    $query->bindParam(':isread',$isread,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
       echo "<script>alert('تم ارسال رسالتك بنجاح، شكرا لك : )   !.');</script>";
       echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
        
    }else {
        
       echo "<script>alert('المعذرة، يبدوا ان هناك خطأ، حاول مجدداً');</script>";
       echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
    }


}


?>
