
<?php
// pr.. root admin
if(isset($_SESSION['ADMIN_ROOT'])){
?>





        <!-- Get Online Admin -->

          <div class="card" dir="rtl" style="font-family: 'Cairo';">
            <div class="card-body pb-0">
              <h5 class="card-title" style="font-family: 'Cairo';">المسؤول المتصل  <span>| اليوم</span></h5>
              <div class="news">

<?php
   
$sql = "SELECT AdminName,profile,TimeLogin  AS timeago from tbladmin WHERE OnLine=1  ORDER BY timeago DESC; ;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
  
                  
?>             <hr>
               <div class="post-item clearfix">
<!--                  <img src="assets/img/icon-admin.png" alt="">-->
<?php
  if(isset($result->profile)){     
      echo "<img src='UPLOADING/Uploads-Images-File-Emploies-Admin/".$result->profile."' class='rounded-circle'>";
      
  }else{
      echo "<img src='assets/img/icon-admin.png'  class='rounded-circle'>";
  }
?>
    
                  <h4><a href="#"><?php echo htmlentities($result->AdminName);?></a></h4>
                   <p>  <snap style="color:green; font-size:17px;"> <?php 
    
    echo TimeAgo($result->timeago, date("Y-m-d H:i:s"));
                       
                       ?> </snap>  </p>
                </div><hr>
<?php  }}  ?>   
                  <br>

              </div>

            </div>
          </div>
<!-- End  Get Online Admin -->








<?php } ?> <!--End If root Admin-->