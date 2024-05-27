   <header class="header-section d-none d-xl-block">
        <div class="header-wrapper">
            <div class="header-bottom header-bottom-color--golden section-fluid sticky-header sticky-color--golden">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <!-- Start Header Logo -->
                            <div class="header-logo">
                                <div class="logo">
<!--                                    <a href="index.php"><img src="<?php echo $DirassetsImage.$ICON; ?>" alt=""></a>-->
                                    <h3 style="font-family: 'Lateef';"><?php echo $CNAME; ?></h3>
                                </div>
                            </div>
                            <!-- End Header Logo -->

                            <!-- Start Header Main Menu -->
                            <div class="main-menu menu-color--black menu-hover-color--golden">
                                <nav>
                                    <ul>
                                        <li class="">
                                            <a class="active main-menu-link" href="index.php">المتجر <i></i></a>
                                        </li>
          
                                        <li class="has-dropdown">
                                            <a href="#">الأقسام <i class="fa fa-angle-down"></i></a>
                                            <!-- Sub Menu -->
                                            <ul class="sub-menu"><?php
                                                
                                                $sql = "SELECT ID,Name FROM tblcategory WHERE Status=1";  
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $ArrayCatoGoryItem=$query->fetchAll(PDO::FETCH_OBJ);
                                                if($query->rowCount() > 0)
                                                {
                                                    foreach($ArrayCatoGoryItem as $resultArrayCatoGoryItem)
                                                    { 
                                                         echo "<li><a  href='All-Product-This-Category.php?CID={$resultArrayCatoGoryItem->ID}'>{$resultArrayCatoGoryItem->Name}</a></li>";
                                                    }
                                                }
                                                
                                                
                                         ?></ul>
                                          
                                        </li>
<!--
                                        <li>
                                            <a href="about-us.php">من نحن</a>
                                        </li>
-->
                                        <li>
                                            <a href="contact-us.php">تواصل معنا</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- End Header Main Menu Start -->

                            <!-- Start Header Action Link -->
                            <ul class="header-action-link action-color--black action-hover-color--golden">
                               <li><?php 
                                     
                                     if(isset($_SESSION['customer'])) {
                                     
                                        echo"<a href='Dashborad.php' class=''><i class='icon-home'></i></a>";
                                         
                                     }else{
                                         
                                          echo"<a href='login.php' class=''><i class='icon-login'></i></a>";
                                         
                                     }
    
                                ?></li>
<!--
                                <li>
                                    <a href="##offcanvas-wishlish" class="offcanvas-toggle">
                                        <i class="icon-heart"></i>
                                        <span class="item-count">3</span>
                                    </a>
                                    
                                </li>
-->
                                <li><?php
                                    
                                  if(isset($_SESSION['cart_p_id']) && isset($_SESSION['couter_items_adds'])) {
                                        
                                         echo " <a href='#offcanvas-add-cart' class='offcanvas-toggle'><i class='icon-bag'></i>
                                        <span class='item-count'>{$_SESSION['couter_items_adds']}</span></span></a>";
                                       
                                    } else {
                                        
                                         echo " <a href='#offcanvas-add-cart' class='offcanvas-toggle'>
                                         <i class='icon-bag'></i></a>";
                                    }
                                    
                                  
                                 ?></li>
                                <li>
                                    <a href="#search">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#offcanvas-about" class="offacnvas offside-about offcanvas-toggle">
                                        <i class="icon-menu"></i>
                                    </a>
                                </li>
                            </ul>
                            <!-- End Header Action Link -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>