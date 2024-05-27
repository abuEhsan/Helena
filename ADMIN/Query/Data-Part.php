<?php
   
$sql = "SELECT Name,logo,Domain,Address,phone1,phone2,ShortDesc FROM `tblcompnydata` LIMIT 1 ;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
  
                  
?>

          <!-- Get Data Part -->
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4" style="margin-bottom: 5%; ">
                <img src="assets/img/<?php echo htmlentities($result->logo); ?>" class="img-fluid rounded-start" alt="<?php echo htmlentities($result->Name);?>" style="" >
              </div>
              <div class="col-md-8" dir="rtl">
                <div class="card-body">
                   <h3 class="card-title" style="font-family: 'Cairo';">بيانات التطبيق </h3><hr>
                   <h6><i class="bi bi"></i> إسم التطبيق <span>|  <?php echo htmlentities($result->Name);?>  </span></h6>
                   <p><i class="bi bi-geo-alt-fill"></i> <?php echo htmlentities($result->Address);?></p>
                   <p><i class="bi bi-tablet-fill"></i> <?php echo htmlentities($result->phone1)." - ".htmlentities($result->phone2);?></p> 
                   <h6><i class="bi bi-link-45deg" style="font-size:22px;"></i> رابط الموقع  |  
                       <span style="color:blue;">  
                        <?php echo htmlentities($result->Domain); ?> 
                       </span>
                    </h6>
                    
                </div>
              </div>
            </div>
          </div>  
         <!-- Get Data Part -->

      

<?php }} ?>