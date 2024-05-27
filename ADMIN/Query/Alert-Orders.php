<?php
$sql_order1 = "SELECT payment_id,customer_name,payment_date FROM tblpayment WHERE  payment_status='Pending'  ORDER  BY id DESC;  ";
$query = $dbh->prepare($sql_order1);
$query->execute();
$results_order1=$query->fetchAll(PDO::FETCH_OBJ);
$op2="";
if($query->rowCount() > 0)
{
foreach($results_order1 as $result_order1)
{ 
    $DateResult=$result_order1->payment_date;
    $currentDate = new DateTime($DateResult);
    $DR=$currentDate->format('Y-M-j H:i:s');
    $ICON='buy_50px.png';
    $op0= "<li class='message-item'>
              <a href='#'><img src='".$DirUPLOADIN_Uploads_File_Products.$ICON."'class='rounded-circle'>
                <div style='text-align: right;'>";
                $op1="<h4>".$result_order1->customer_name."</h4>";
    //GET DESC
//GET PRODUCT NAME
    $sql_order2 = "SELECT product_name FROM tblorder WHERE payment_id='$result_order1->payment_id';";
    $query = $dbh->prepare($sql_order2);
    $query->execute();
    $results_order2=$query->fetchAll(PDO::FETCH_OBJ);
    foreach($results_order2 as $result_order2)
    {  
        //Format Text About
        $FormatStr=substr(filter_var($result_order2->product_name, FILTER_SANITIZE_STRING), 0, 15);
        $op2.= " <p><span dir='rtl' style='color:black;'> - ".$FormatStr."</span><i style=' font-size:18px;'> ... </i><br></p>";       
        $op3="        <p>".$DR."</p>";
        
         $op4=   " </div>
                  </a>
              </li> ";
        
         
    }
  }
    echo $op0.$op1.$op2.$op3.$op4;
}else{
    echo "<p>"." لا توجد طلبات حديثة "."</p>";
}
?>

            <li>
              <hr class="dropdown-divider">
            </li>

