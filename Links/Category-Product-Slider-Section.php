<?php
$sql="SELECT * FROM tblcategory WHERE Status=1 ";
$query = $dbh->prepare($sql); 
$query->execute();
$resultsCate=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($resultsCate as $resultCate)
{ 

?>

<!-- Start Product Default Slider Section -->
    <div class="product-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                               
                                <h1 class="section-title"><?php echo " قسم " .$resultCate->Name; ?></h1>
                                <p>قم باستعراض منتجاتنا لقسم <span><?php $resultCate->Name; ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="product-wrapper" data-aos="fade-up" data-aos-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-slider-default-2rows default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container product-default-slider-4grid-2row">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper"><?php
// $sql = "SELECT id,Name AS PN,Icon,price,current_price,CurrencyId,qualty,alt FROM tblproducts  WHERE CategoryId='$resultCate->ID' AND Status=1 ORDER BY CreateDate ";
$sql = "SELECT p.id,p.Name AS PN,p.Icon,p.about,p.price,p.price,p.current_price,p.CurrencyId,p.qualty,p.alt,p.CreateDate,c.Name AS CN,c.Image
FROM tblproducts p
JOIN tblcategory c ON p.CategoryId = c.ID
WHERE p.CategoryId='$resultCate->ID' AND  p.Status = 1 AND c.Status=1
ORDER BY p.CreateDate DESC";
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
                                                <img src="<?php echo $DirUPLOADIN_Uploads_File_Products.$result->Icon;?>" alt="<?php echo htmlentities($result->alt);?>">
                                                <img src="<?php echo $DirUPLOADIN_Uploads_File_Products.$result->Icon;?>" alt="<?php echo htmlentities($result->alt);?>">
                                            </a>
                                            <div class="tag">
<!--                                                <span>بيع</span>-->
                                            </div>
                                            <div class="action-link">
                                                <div class="action-link-left">
<!--
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modalAddcart">إضافة للسلة</a>
-->
                                                <a><?php 
    
    //BUTTON ADD TO CART
if (isset($_SESSION['cart_p_id']) && in_array($result->id, $_SESSION['cart_p_id'])) {
    echo " <a > تمت الاضافة  </a>";
}else if($result->qualty <= '0'){
    echo " <a> <span style='color:red;'> الكمية نفذة </span> </a>";
}else{
    echo " <a  href='Add-To-Cart.php?PID=".$result->id."'>إضافة للسلة </a>";
}
                                                    
                                                    
                                                    
                                                    ?></a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a  data-bs-toggle="modal" data-bs-target="##modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a id="whishstate"><i class="icon-heart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.php?PID=<?php echo htmlentities($result->id);?>"><?php 
    
        echo htmlentities($resultCate->Name) ." | ". htmlentities($result->PN);
                                                    
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
<?php } } //END LOOP PRODUCT  ?></div>
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
    <!-- End Product Default Slider Section -->
<?php }} //END LOOPD CATEGORY ?>

