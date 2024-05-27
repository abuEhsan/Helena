

       <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title" dir="rtl" style="font-family: 'Cairo';">المبيعات <span>| المنتجات الأكثر طلبا </span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">المنتج</th>
                        <th scope="col">أيقونة المنتج</th>
                        <th scope="col"> الكمية</th>
                        <th scope="col"> الإجراء</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
<?php

$sql = "SELECT DISTINCT o.product_name\n"

    . "FROM tblorder o\n"

    . "JOIN tblpayment p \n"

    . "ON o.payment_id=p.payment_id\n"

    . "WHERE p.payment_status='Pending' AND p.shipping_status='Pending' ORDER  BY p.id DESC;";

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
                         <td>
                          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            <li
                              data-bs-toggle="tooltip"
                              data-popup="tooltip-custom"
                              data-bs-placement="top"
                              class="avatar avatar-xs pull-up"
                              title="Lilian Fuller"
                            >
                              <img src="./assets/img/shopify_64px.png" alt="صورة" class="rounded-circle" />
                            </li>
                            <li
                              data-bs-toggle="tooltip"
                              data-popup="tooltip-custom"
                              data-bs-placement="top"
                              class="avatar avatar-xs pull-up"
                              title="Sophia Wilkerson"
                            >
                              <img src="./assets/img/shopify_64px.png" alt="صورة" class="rounded-circle" />
                            </li>
                          </ul>
                        </td>
                        <td><?php  
$sql2 = "SELECT SUM(quantity) AS TOT FROM `tblorder` WHERE product_name='$result->product_name';";
$query = $dbh->prepare($sql2);
$query->execute();
$results2=$query->fetch();
echo  $results2['TOT'];
                            
                            ?> </td>
                        <td>
                            
                            <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-edit-alt me-1"></i> معاينة</a
                              >
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-trash me-1"></i> حذف</a
                              >
                            </div>
                          </div>
                          
                        </td>
                                          
                          
                      </tr>
<?php $cnt++; }} ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->