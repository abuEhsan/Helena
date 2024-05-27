

       <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title" style="font-family: 'Cairo';">الطلبات <span>| أخر الطلبات الحديثة </span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">أسم المنتج </th>
                        <th scope="col">كمية البيع</th>
                      </tr>
                    </thead>
                    <tbody>
<?php

$sql = "SELECT o.product_name  \n"

    . "FROM tblorder o\n"

    . "JOIN tblpayment p \n"

    . "ON o.payment_id=p.payment_id\n"

    . "WHERE p.payment_status='Completed' AND p.shipping_status='Completed' ORDER  BY o.id DESC;";

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
//    $DateResult=$result->payment_date;
//    $currentDate = new DateTime($DateResult);
//    $DR=$currentDate->format('Y-M-j H:i:s');

?>
                      <tr>
                        <td><?php echo htmlentities($cnt);?></td>
                        <td><?php echo htmlentities($result->product_name);?></td>
                        <td><?php echo htmlentities("");?> </td>
                                          
                          
                      </tr>
<?php $cnt++; }} ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->