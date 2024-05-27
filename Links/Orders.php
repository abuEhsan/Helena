
<table dir="rtl">
    <thead>
        <tr>
            <td>#</td>
            <td>رقم الطلب</td>
            <td>تفاصيل المنتجات"</td>
            <td>تفاصيل الحوالة</td>
            <td>القيمة</td>
            <td>حالة الطلب</td>
            <td>آلية الدفع</td>
            <td>تاريخ الدفع</td>
        </tr>
    </thead>
    <body><?php
           
            $sql = "SELECT * FROM tblpayment WHERE customer_email='{$_SESSION['customer']['cust_email']}' ORDER BY id DESC";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=0;
            if($query->rowCount() > 0)
            {
            foreach($results as $result)
            {                    
            ?>
        <tr>
            <td><?php echo ++$cnt; ?></td>
            <td><?php echo $result->payment_id; ?></td>
            <td><?php
                   $statement1 = $dbh->prepare("SELECT * FROM tblorder WHERE payment_id=?");
                   $statement1->execute(array($row['payment_id']));
                   $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                   foreach ($result1 as $row1) {
                       echo 'اسم المنتج: '.$row1['product_name'];
                       echo '<br>الكمية: '.$row1['quantity'];
                       echo '<br>القيمة:'.$row1['unit_price'];
                   }
              ?></td>
            <td><?php echo $result->bank_transaction_info; ?></td>
            <td><?php echo $result->paid_amount; ?></td>
            <td><?php 
                
                    if($result->payment_status=='Pending'){
                        echo "قيد التحقق";
                    }else if($result->payment_status=='Completed' && $result->shipping_status=='Pending'){
                        echo "تم الدفع - قيد التوصيل";
                    }else if($result->payment_status=='Completed' && $result->shipping_status =='Pending'){
                        echo "تم التسليم ";
                    }else{
                        echo "يرجى مراجعة المتجر";
                    }
                                    
              ?></td>
            <td><?php 
                
                        if($result->payment_method=='Bank Deposit'){
                            echo"حوالة بنكية";
                        }else{
                            echo $result->payment_method; 
                        }
                                            
             ?></td>
            <td dir="ltr"><?php echo $result->payment_date; ?></td>
            
        </tr>
      <?php } }else{
                echo "<tr><td colspan=></td></tr>";
            } ?>
    </body>
</table>
