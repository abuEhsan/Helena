 <div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- End Offcanvas Header -->
        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-mobile-menu-wrapper">
            <!-- Start Mobile Menu  -->
            <div class="mobile-menu-bottom">
                <!-- Start Mobile Menu Nav -->
                <div class="offcanvas-menu">
                    <ul>
                        <li>
                            <a href="#"><span>المتجر</span></a>
                        </li>
                        <li>
                            <a href="#"><span>الأقسام</span></a>
                                <!-- Sub Menu -->
                            <ul class="mobile"><?php
                                
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
                        <li><a href="about-us.php">حولنا</a></li>
                        <li><a href="contact-us.php">تواصل معنا</a></li>
                    </ul>
                </div> <!-- End Mobile Menu Nav -->
            </div> <!-- End Mobile Menu -->

            <!-- Start Mobile contact Info -->
            <div class="mobile-contact-info">
                <div class="logo">
<!--                    <a href="index.php"><img src="<?php echo $DirassetsImage.$ICON; ?>" alt=""></a>
-->
                    <h3 style='color:white;'><?php echo $CNAME; ?></h3>
                </div>

                <address class="address">
                    <span><?php echo "العنوان: ".$ADDRESS;  ?></span>
<!--                    <span><?php echo "الرقم التجاري: ".$CommercialNumber;  ?></span>-->
                    <span><?php echo "الهاتف: ".$phone1;  ?></span>
                    <span><?php echo "الايميل: ".$Email;  ?></span>
                </address>
                 <ul class="social-link">
                    <li style='margin-right: 1%;'><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li style='margin-right: 1%;'><a href="https://wa.link/b2zxn7"><i class="fa fa-whatsapp"></i></a></li>
                    <li style='margin-right: 1%;'><a href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>

<!--
                <ul class="social-link"><?php 
$sql = "SELECT social_url, social_name,social_icon FROM `tblsocial` ;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
    foreach($results as $result)
    {    

         if($result->social_url){
             
             echo "<li style='margin-right: 1%;'><a href='{$result->social_url}'><i class='{$result->social_icon}' ></i><a/></li>";
             
         }
    }
}         
                ?></ul>
-->

                <ul class="user-link">
<!--                       <li><a href="Wishlist.php">التفضيلات</a></li>-->
                        <li><a href="Cart.php">الكارد</a></li>
                        <li><a href="Checkout.php">اتمام الشراء</a></li>
                </ul>
            </div>
            <!-- End Mobile contact Info -->

        </div> <!-- End Offcanvas Mobile Menu Wrapper -->
    </div> 
   





<!---->





    <div id="offcanvas-about" class="offcanvas offcanvas-rightside offcanvas-mobile-about-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- End Offcanvas Header -->
        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <!-- Start Mobile contact Info -->
        <div class="mobile-contact-info">
            <div class="logo">
<!--                <a href="index.php"><img src="<?php echo $DirassetsImage.$ICON; ?>" alt=""></a>-->
<!--             <h3><?php echo $CNAME; ?></h3>-->
            </div>

            <address class="address">
                <span><?php echo "العنوان: ".$ADDRESS;  ?></span>
                <span><?php echo "الهاتف: ".$phone1;  ?></span>
                <span><?php echo "الايميل: ".$Email;  ?></span>
            </address>
             <ul class="social-link">
                    <li style='margin-right: 1%;'><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li style='margin-right: 1%;'><a href="https://wa.link/b2zxn7"><i class="fa fa-whatsapp"></i></a></li>
                    <li style='margin-right: 1%;'><a href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>

<!--
            <ul class="social-link"><?php 
$sql = "SELECT social_url, social_name,social_icon FROM `tblsocial` ;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
    foreach($results as $result)
    {    
        

         if($result->social_url){
             
             echo "<li style='margin-right: 1%;'><a href='{$result->social_url}'><i class='{$result->social_icon}' ></i><a/></li>";
             
         }
    }
}         
                ?></ul>
-->

            <ul class="user-link">
<!--                <li><a href="Wishlist.php">التفضيلات</a></li>-->
                <li><a href="Cart.php">الكارد</a></li>
                <li><a href="Checkout.php">اتمام الشراء</a></li>
            </ul>
        </div>
        <!-- End Mobile contact Info -->
    </div> 
   

<!---->


    <div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- ENd Offcanvas Header -->

        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-wishlist-wrapper">
            <h4 class="offcanvas-title">التفضيلات</h4>
            <ul class="offcanvas-wishlist"  dir="ltr">
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="assets/images/product/default/home-1/default-1.jpg" alt=""
                                class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Car Wheel</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$49.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="assets/images/product/default/home-2/default-1.jpg" alt=""
                                class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Car Vails</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">3 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$500.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="assets/images/product/default/home-3/default-1.jpg" alt=""
                                class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Shock Absorber</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$350.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
            </ul>
            <ul class="offcanvas-wishlist-action-button">
                <li><a href="#" class="btn btn-block btn-golden">معاية التفضيلات</a></li>
            </ul>
        </div> <!-- End Offcanvas Mobile Menu Wrapper -->

    </div> 


