             <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>تفاصيل المنتج</th>
                                            <th>القيمة</th>
                                            <th>حالة الطلب</th>
                                            <th>آلية الدفع</th>
                                            <th> تاريخ الطلب</th>
                                            <th> رقم الطلب</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                            <td>1</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                         
                                        </tr>
                                   
                                    </tbody>
                                </table>
<table>
    <thead>
        <tr>
            <t>#</t>
            <t>رقم الطلب</t>
            <t>تفاصيل المنتجات"</t>
            <t>تفاصيل الحوالة</t>
            <t>القيمة</t>
            <t>حالة الطلب</t>
            <t>آلية الدفع</t>
            <t>تاريخ الدفع</t>
        </tr>
    </thead>
    <body><?php
            /* ===================== Pagination Code Starts ================== */
            $adjacents = 5;

            $statement = $dbh->prepare("SELECT * FROM tblpayment WHERE customer_email=? ORDER BY id DESC");
            $statement->execute(array($_SESSION['customer']['cust_email']));
            $total_pages = $statement->rowCount();

            $targetpage = BASE_URL.'Orders.php';
            $limit = 10;
            $page = @$_GET['page'];
            if($page) 
                $start = ($page - 1) * $limit;
            else
                $start = 0;
            
            
            $statement = $dbh->prepare("SELECT * FROM tblpayment WHERE customer_email=? ORDER BY id DESC LIMIT $start, $limit");
            $statement->execute(array($_SESSION['customer']['cust_email']));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
           
            
            if ($page == 0) $page = 1;
            $prev = $page - 1;
            $next = $page + 1;
            $lastpage = ceil($total_pages/$limit);
            $lpm1 = $lastpage - 1;   
            $pagination = "";
            if($lastpage > 1)
            {   
                $pagination .= "<div class=\"pagination\">";
                if ($page > 1) 
                    $pagination.= "<a href=\"$targetpage?page=$prev\">&#171; previous</a>";
                else
                    $pagination.= "<span class=\"disabled\">&#171; previous</span>";    
                if ($lastpage < 7 + ($adjacents * 2))
                {   
                    for ($counter = 1; $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                    }
                }
                elseif($lastpage > 5 + ($adjacents * 2))
                {
                    if($page < 1 + ($adjacents * 2))        
                    {
                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                        $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
                    }
                    elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                    {
                        $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                        $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                        $pagination.= "...";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                        $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
                    }
                    else
                    {
                        $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                        $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                        $pagination.= "...";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                        }
                    }
                }
                if ($page < $counter - 1) 
                    $pagination.= "<a href=\"$targetpage?page=$next\">next &#187;</a>";
                else
                    $pagination.= "<span class=\"disabled\">next &#187;</span>";
                $pagination.= "</div>\n";       
            } 
            /* ===================== Pagination Code Ends ================== */
            $tip = $page*10-10;
            foreach ($result as $row) {
             $tip++;
                
            ?>
        <tr>
            <td><?php echo $tip; ?></td>
            <td><?php echo $row['payment_id']; ?></td>
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
            <td><?php echo $row['bank_transaction_info']; ?></td>
            <td><?php echo $row['paid_amount']; ?></td>
            <td><?php 
                      if($row['payment_status']=='Pending'){
                         echo "قيد التحقق";
                      }                 if($row['payment_status']=='Completed'                  $row['shipping_status']=='Pending'){
                       echo "تم الدفع - قيد التوصيل";
                      }                 if($row['payment_status']=='Completed'                  $row['shipping_status']=='Pending'){
                     echo "تم التسليم ";
                     }else{
                      echo "يرجى مراجعة المتجر";
                     }
                                    
              ?></td>
            <td><?php 
                
                        if($row['payment_method']=='Bank Deposit'){
                            echo"حوالة بنكية";
                        }else{
                            echo $row['payment_method']; 
                        }
                                            
             ?></td>
            <td><?php echo $row['payment_date']; ?></td>
            <td></td>
        </tr>
      <?php } ?>
    </body>
</table>
<div class="pagination" style="overflow: hidden;">
                       
</div>