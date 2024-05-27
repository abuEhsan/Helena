 <div class="mobile-header mobile-header-bg-color--golden section-fluid d-lg-block d-xl-none">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <!-- Start Mobile Left Side -->
                    <div class="mobile-header-left">
                        <ul class="mobile-menu-logo">
                            <li>
                                <a href="index.php">
                                    <div class="logo">
<!--                                        <img src="<?php echo $DirassetsImage.$ICON; ?>" alt="">-->
                                        <h3><?php echo $CNAME; ?></h3>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Mobile Left Side -->

                    <!-- Start Mobile Right Side -->
                    <div class="mobile-right-side">
                        <ul class="header-action-link action-color--black action-hover-color--golden">
                            <li><?php 
                                     
                                     if(isset($_SESSION['customer'])) {
                                     
                                        echo"<a href='Dashborad.php' class=''><i class='icon-home'></i></a>";
                                         
                                     }else{
                                         
                                          echo"<a href='login.php' class=''><i class='icon-login'></i></a>";
                                         
                                     }
    
                            ?></li>
                            <li>
                                <a href="#search">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
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
                                <a href="#mobile-menu-offcanvas" class="offcanvas-toggle offside-menu">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Mobile Right Side -->
                </div>
            </div>
        </div>
    </div>
   