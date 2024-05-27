 
<?php 
//GET CATEGORY
$sqlCateg = "SELECT CategoryId from tblproducts WHERE id ='$ID' ";
$query = $dbh->prepare($sqlCateg);
$query->execute();
if($query->rowCount() > 0)
{     
?>
<div class="product-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3 class="section-title">المنتجات ذات الصلة</h3>
                                <p>منتجات ذات صلة بهذا المنتج</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="product-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-slider-default-1row default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container product-default-slider-4grid-1row">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper"><?php
//FETCH CATEGORY
$CategoryID=$query->fetch();                                
$sql = "SELECT\n"

    . "    p.id,p.Name AS PN,p.Icon,p.about,p.price,p.price,p.current_price,p.CurrencyId,p.qualty,p.alt,p.CreateDate,c.Name AS CN,c.Image\n"

    . "FROM\n"

    . "    tblproducts p\n"

    . "JOIN tblcategory c ON\n"

    . "    p.CategoryId = c.ID\n"

    . "WHERE\n"

    . "    p.Status = 1 AND c.ID='{$CategoryID['CategoryId']}'\n"

    . "ORDER BY\n"

    . "    p.CreateDate\n"

    . "DESC ";

$query = $dbh->prepare($sql); 
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{     
   //Format Text About
//     $FormatStr=substr(filter_var($result->about, FILTER_SANITIZE_STRING), 0, 400);
?>
                                  
                                    
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.php" class="image-link">
                                                <img src="<?php echo $DirUPLOADIN_Uploads_File_Products.phpentities($result->Icon);?>" alt="">
                                                <img src="<?php echo $DirUPLOADIN_Uploads_File_Products.phpentities($result->Icon);?>" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                  <a><?php 
    
    //BUTTON ADD TO CART
if (isset($_SESSION['cart_p_id']) && in_array($result->id, $_SESSION['cart_p_id'])) {
    echo " <a > تمت الاضافة  </a>";
}else if($result->qualty <= '0'){
    echo " <a> <span style='color:red;'> الكمية نفذة </span> </a>";
}else{
    echo " <a  href='Add-To-Cart.php?PID=".phpentities($result->id)."'>إضافة للسلة </a>";
}
                                                    
                                                    
                                                    
                                                 ?></a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="##modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a id="whishstate"><i class="icon-heart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.php?PID=<?php echo htmlentities($result->id);?>"><?php 
    
    echo htmlentities($result->CN) ." | ". htmlentities($result->PN);
                                                    
                                                ?></a></h6>
<!--
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
-->
                                            </div>
                                            <div class="content-right">
                                                <span class="price"><?php 
$sql2 = "SELECT Name from tblcurrncy WHERE ID ='$result->CurrencyId' ";
$query = $dbh->prepare($sql2);
$query->execute();
$results2=$query->fetch();
echo htmlentities($result->price)." ".$results2['Name'];
                                                    
                                                    ?></span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
 <?php }} 
                                

                              
                            ?></div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php }else{ ?>
        <div class="product-default-single-item product-color--golden swiper-slide">                              
            <h6 class="title" style="color:red;">لا توجد نتائج متوفرة حالياً! </h6>                            
        </div>
<?php } ?>

