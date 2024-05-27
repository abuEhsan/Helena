  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
            <a class="nav-link collapsed" href="dashboard.php">
              <i class="bi bi-grid-3x3-gap-fill"></i>
              <span>  <?php echo "  لوحة التحكم ";?> </span>
            </a>
          </li><!-- End Dashboard Nav -->


        <li class="nav-item">
           <a class="nav-link collapsed" data-bs-target="#Pleading-nav" data-bs-toggle="collapse" href="#">
             <i class="bi bi-cart4"></i><span>  <?php echo " الطلبات";?>  </span><i class="bi bi-chevron-down ms-auto"></i>
           </a>
           <ul id="Pleading-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
               <a href="Manage-Orders-Shopping.php">
                 <i class="bi bi-circle"></i><span>  <?php echo "إدارة الطلبات";?> </span>
               </a>
            </li>

           </ul>
        </li><!-- End Orders Nav --> 
        <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#Adds-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-megaphone-fill"></i><span>  <?php echo "العروض";?>  </span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Adds-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                    <a href="Adds.php">
                      <i class="bi bi-circle"></i><span>  <?php echo "إدارة العروض";?> </span>
                    </a>
                  </li>
                </ul>
        </li><!-- End Add Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#Product-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-palette2"></i><span> <?php echo "الاصناف/المنتجات ";?></span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Product-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="Products.php">
                  <i class="bi bi-circle"></i><span><?php echo "إدارة المنتجات";?></span>
                </a>
              </li>
             <li>
                <a href="Category.php">
                  <i class="bi bi-circle"></i><span><?php echo "إدارة الأصناف";?></span>
                </a>
              </li>
            </ul>
        </li>
      
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#Page-op-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-gear-fill"></i><span> <?php echo " اعدادات العمليات";?></span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Page-op-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="Currnces.php">
                  <i class="bi bi-circle"></i><span><?php echo " العملات ";?></span>
                </a>
              </li>
              <li>
                <a href="Payments-Away.php">
                  <i class="bi bi-circle"></i><span><?php echo "طرق الدفع";?></span>
                </a>
              </li>
              <li>
                <a href="Shipping-Cost.php">
                  <i class="bi bi-circle"></i><span><?php echo "الحسابات البنكية ";?></span>
                </a>
              </li>
            </ul>
        </li> -->
        <!-- End Setting Nav -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#Page-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-sliders"></i><span> <?php echo " اعدادات القوائم";?></span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Page-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="Manage-Slider-Main.php">
                  <i class="bi bi-circle"></i><span><?php echo " العارض الرئيسي";?></span>
                </a>
              </li>
              <li>
                <a href="Manage-Slider-Service.php">
                  <i class="bi bi-circle"></i><span><?php echo " عارض الخدمات ";?></span>
                </a>
              </li>
            </ul>
        </li> -->
        <!-- End Setting Nav -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#Cust-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-people-fill"></i><span> <?php echo "الموارد البشرية  ";?></span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Cust-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="Manage-Customers.php">
                  <i class="bi bi-circle"></i><span><?php echo "إدارة المشتركين";?></span>
                </a>
              </li>
             <li>
                <a href="Clints.php">
                  <i class="bi bi-circle"></i><span><?php echo "إدارة العملاء";?></span>
                </a>
              </li>
            </ul>
        </li> -->
        <!-- End Products Nav -->
        

        <li class="nav-heading">تنقلات الصفحات</li>
          <li class="nav-item">
        <a class="nav-link collapsed" href="Manage-Messages.php">
          <i class="bi bi-envelope-fill"></i>
          <span><?php echo " إدارة الأتصالات ";?></span>
        </a>
        </li><!-- End links Page Nav -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="Links.php">
          <i class="bi bi-link-45deg"></i>
          <span><?php echo " إدارة الروابط ";?></span>
        </a>
        </li><!-- End links Page Nav -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="Question-And-Answer.php">
            <i class="bi bi-question-circle"></i>
            <span><?php echo "إدارة الاسئلة الشائعة ";?> </span>
        </a>
        </li><!-- End F.A.Q Page Nav -->
         
        <li class="nav-item">
              <a class="nav-link collapsed" href="Pro-Conditions.php">
                <i class="bi bi-list"></i>
                <span><?php echo " إدارة البنود ";?></span>
              </a>
        </li>
        <!-- End Conditions Page Nav -->
           
        



        
    </ul>

  </aside><!-- End Sidebar-->
