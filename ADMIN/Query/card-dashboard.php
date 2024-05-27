<?php 


$sql="SELECT  id from tblvisits";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalVisits=$query->rowCount();
//GET ALL CONTECT
$sql="SELECT id FROM `tblcontactdata`";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalcontm=$query->rowCount();

//GET ALL PRODUCTS  
$sql ="SELECT ID from tblproducts ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$producttotl=$query->rowCount();

//GET ALL CUSTOMERS    
$sql ="SELECT cust_id from tblcustomer ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$Cusomerstotl=$query->rowCount();
//GET ALL ADDS
$sql ="SELECT id from tbladds ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$addstotl=$query->rowCount();




// query get all Category
$statement = $dbh->prepare("SELECT * FROM tblcategory");
$statement->execute();
$total_category = $statement->rowCount();
// query get all products
$statement = $dbh->prepare("SELECT * FROM tblproducts");
$statement->execute();
$total_product = $statement->rowCount();
// query get all Adds
$statement = $dbh->prepare("SELECT * FROM tbladds");
$statement->execute();
$total_adds = $statement->rowCount();
//query get total all customers
$statement = $dbh->prepare("SELECT * FROM tblcustomer WHERE cust_status='1'");
$statement->execute();
$total_customers = $statement->rowCount();

// query get all shipping cost opretion
$statement = $dbh->prepare("SELECT * FROM tblshippingcost");
$statement->execute();
$available_shipping = $statement->rowCount();
//query get all subcriper
$statement = $dbh->prepare("SELECT subs_id FROM tblsubscriber");
$statement->execute();
$Subsctotl = $statement->rowCount();

//QUERY ORDERS__________________________

//New Orders 
$statement = $dbh->prepare("SELECT * FROM tblpayment WHERE payment_status=?");
$statement->execute(array('Pending'));
$total_order_pending = $statement->rowCount();
// مشحونة جاهزة للنقل
$statement = $dbh->prepare("SELECT * FROM tblpayment WHERE payment_status=? AND shipping_status=?");
$statement->execute(array('Completed','Pending'));
$total_order_complete_shipping_pending = $statement->rowCount();

//Orders & pending Comepleteds
$statement = $dbh->prepare("SELECT * FROM tblpayment WHERE payment_status=? AND shipping_status=?");
$statement->execute(array('Completed','Completed'));
$total_order_complete_shipping_Completed = $statement->rowCount();






?>           
          <!--# START CARDS-->


            <!-- Messegs Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title" style="font-family: 'Cairo';" dir="rtl"> <?php echo "الأتصالات"; ?> <span>| <?php echo "جميع الأتصالات"; ?>  </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-envelope-fill" style="color:green;"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo htmlentities($totalcontm);?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Messegs Card -->
            <!-- Orders 1 Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title" style="font-family: 'Cairo';" dir="rtl"> <?php echo "الطلبات"; ?><span>| <?php echo "جميع الطلبات الحديثة   "; ?>  </span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart-plus-fill" style="color:green;"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo htmlentities($total_order_pending);?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Orders 1 Card -->
            <!-- Orders 2 Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title" style="font-family: 'Cairo';" dir="rtl"> <?php echo "الطلبات"; ?><span>| <?php echo "جميع الطلبات قيد الشحن والتوصيل  "; ?>  </span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-truck " style="color:red;"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo htmlentities($total_order_complete_shipping_pending);?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Orders 2 Card -->
            <!-- Orders 3 Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title" style="font-family: 'Cairo';" dir="rtl"> <?php echo "الطلبات"; ?><span>| <?php echo "جميع الطلبات المكتملة    "; ?>  </span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard-check" ></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo htmlentities($total_order_complete_shipping_Completed);?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Orders 3 Card -->
            <!-- Products Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title" style="font-family: 'Cairo';" dir="rtl"> <?php echo "المنتجات"; ?><span>| <?php echo " جميع المنتجات  "; ?>  </span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-palette2" ></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo htmlentities($producttotl);?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Products Card -->
            <!-- Category Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title" style="font-family: 'Cairo';" dir="rtl"> <?php echo "الأصناف"; ?><span>| <?php echo " جميع الأصناف   "; ?>  </span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-tag" ></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo htmlentities($producttotl);?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Category Card -->
    
            <!-- Adds Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title" style="font-family: 'Cairo';" dir="rtl"> <?php echo "العروض"; ?><span>| <?php echo "جميع العروض "; ?>  </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-megaphone-fill" ></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo htmlentities($addstotl);?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Adds Card -->
           
            <!-- Clints Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title" style="font-family: 'Cairo';" dir="rtl"> <?php echo "العملاء"; ?><span>| <?php echo "جميع عملائنا "; ?>  </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill" ></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo htmlentities($Cusomerstotl);?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Clints Card -->
            <!-- Clints Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title" style="font-family: 'Cairo';" dir="rtl"> <?php echo "الأشتراكات"; ?><span>| <?php echo "جميع إشتراكات البريدية"; ?>  </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-mailbox2" ></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo htmlentities($Subsctotl);?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Clints Card -->




        <!--# END CARDS-->