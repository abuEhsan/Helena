<?php
session_start(); 
include('Link/error-reporting.php');
include('Link/config.php');
include('Link/Setting.php');
include("Link/Dir.php"); 
include("Link/Favicons.php");


    if(isset($_POST['submit']))
    {

        $target_dir=$DirUPLOADIN_Uploads_File_Products;
        //load logo file   
        $target_file= $target_dir . basename($_FILES["Icon"]["name"]);
        $Iconfile=$_FILES["Icon"]["name"];
        move_uploaded_file($_FILES["Icon"]["tmp_name"], $target_file);
        $PCA=$_POST['CA'];    
        $PNA=$_POST['NA'];
        $PABU=$_POST['ABU'];
        $PLD=$_POST['LD'];
        $PPR=$_POST['PR'];
        $PCUR=$_POST['CUR'];
        $PQTY=$_POST['QTY'];
        $PGR=$_POST['GR'];
        $PSS=$_POST['SS'];
        //CHECHED FROM FOUND OR NOT
        $sql="SELECT ID  FROM `tblproducts` WHERE CategoryId='$PCA' AND Name='$PNA' ";
        $query = $dbh->prepare($sql);
        $query->execute();
        if($query->rowCount() > 0)
        {
            $erorr="المعذرة، هذا الصنف  موجود مسبقا في قاعدة البيانات"; 

        }else{
            
        $sql="INSERT INTO `tblproducts`(`CategoryId`, `AdminId`, `Name`,`Icon`, `about`,linkdemo,`price`,`CurrencyId`, `qualty`,`typeIcon`,`alt`,`Status` ) VALUES (:CA,'".$_SESSION['ADMIN_ID']."',:NA,'$Iconfile',:ABU,:LD,:PR,:CUR,:QTY,:GR,:NA,:SS)" ; 
        $query = $dbh->prepare($sql);
        $query->bindParam(':CA',$PCA,PDO::PARAM_INT);
        $query->bindParam(':NA',$PNA,PDO::PARAM_STR);
        $query->bindParam(':ABU',$PABU,PDO::PARAM_STR);
        $query->bindParam(':LD',$PLD,PDO::PARAM_STR);
        $query->bindParam(':PR',$PPR,PDO::PARAM_STR);
        $query->bindParam(':CUR',$PCUR,PDO::PARAM_STR);
        $query->bindParam(':QTY',$PQTY,PDO::PARAM_INT);
        $query->bindParam(':GR',$PGR,PDO::PARAM_INT);
        $query->bindParam(':SS',$PSS,PDO::PARAM_INT);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();  
        if($lastInsertId)
        {
            // load more images
                $c=count($_FILES['Images']['name']);
                if($c < 10){
                                for ($i=0; $i <$c; $i++) { 
                                    $img_name=$_FILES['Images']['name'][$i];
                                    move_uploaded_file($_FILES['Images']['tmp_name'][$i] , $target_dir .$img_name);
                                    $sql="INSERT INTO tbldetailsImages(Images,proid) VALUES ('$img_name','$lastInsertId')";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();

                                }
                    }else{
                        $erorr= " "."بلغت الحد الاقصى لعملية تمحميل الملفات";
                    }

            $msg="تم إضافة الملف بنجاح";
            echo "<script type='text/javascript'> alert('".$msg."') </script>";
            echo "<script type='text/javascript'> document.location = 'Products.php'; </script>";  
        }else{
            
             $erorr="المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!"; 
             echo "<script type='text/javascript'> alert('".$erorr."') </script>";
             echo "<script type='text/javascript'> document.location = 'Products.php'; </script>";
        }
  

     }//END CHECHED FROM FOUND OR NOT
    }// END SUBMIT
     