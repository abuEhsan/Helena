  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
       <img src="<?php echo htmlentities($DirassetsImage.$ICON);?>" alt="">
        <span class="d-none d-lg-block" style="font-family: 'Cairo';"> <?php echo htmlentities($CNAME);?>  </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">

    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
          
       

        <li class="nav-item dropdown" >
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" >
            <i class="bi bi-cart2"></i>
            <span class="badge bg-success badge-number"><?php 
$sql ="SELECT id FROM tblpayment WHERE payment_status ='Pending';";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
echo $totalPleading=$query->rowCount();
                
                ?></span>
          </a><!-- End Notification Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
            <?php echo "عدد الطلبات "." ".$totalPleading  ?>
              <a href="Manage-Orders-Shopping.php"><span class="badge rounded-pill bg-primary p-2 ms-2">عرض الجميع</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <?php //include'Query/Alert-Orders.php'; ?>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="Manage-Orders-Shopping.php">عرض جميع الطلبات</a>
            </li>
          </ul><!-- End Pleading Dropdown Items -->
        </li><!-- End Pleading Nav -->

     
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-primary badge-number"><?php 
$sql ="SELECT id from  tblcontactdata  WHERE Is_Read !=1 ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
echo $totalMessages=$query->rowCount();
                
                ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
            <?php echo "عدد الرسائل "." ".$totalMessages  ?>
              <a href="Manage-Messages.php"><span class="badge rounded-pill bg-primary p-2 ms-2">عرض الجميع</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
             <?php include'Query/Alert-Messages.php'; ?>
            <li class="dropdown-footer">
              <a href="Manage-Messages.php">عرض جميع الرسائل</a>
            </li>
           
          </ul>
        </li><!-- End Messages Nav -->
          
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
<?php
  if(isset($_SESSION['ADMIN_PROFILE'])){     
      echo "<img src='UPLOADING/Uploads-Images-File-Emploies-Admin/".$_SESSION['ADMIN_PROFILE']."' class='rounded-circle'>";
      
  }else{
      echo "<img src='UPLOADING/Uploads-Images-File-Emploies-Admin/icon-admin.png'  class='rounded-circle'>";
  }
?>
            <span class="d-none d-md-block dropdown-toggle ps-2">  <?php echo $_SESSION['ADMIN_USERNAME'];?> </span><br>
          </a><!-- End Profile Iamge Icon -->
            
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['ADMIN_NAME'];?></h6>
              <span>( <?php echo htmlentities($today);  ?> )</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>ملفي الشخصي</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="change-password.php">
                <i class="bi bi-key"></i>
                <span> تحديث كلمة المرور</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="Setting-System.php">
                <i class="bi bi-gear"></i>
                <span> تحديث معلومات النظام</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center"  href="logoutAdmin.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>تسجيل الخروج</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
