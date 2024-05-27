<!-- Start Product Default Slider Section -->
<div class="product-default-slider-section section-top-gap-100 section-fluid">
    <!-- Start Section Content Text Area -->
    <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content-gap">
                        <div class="secton-content">
                            <h3 class="section-title">المنتجات الحديثة</h3>
                            <p>قم باستعراض احد منتجاتنا ... نسعى لتقديم المنتج الأفضل لكم</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Section Content Text Area -->
    <div class="product-wrapper" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-slider-default-2rows default-slider-nav-arrow">
                        <!-- Slider main container -->
                        <div class="swiper-container product-default-slider-4grid-2row">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <?php
                                $sql = "SELECT p.id,p.Name AS PN,p.Icon,p.about,p.price,p.price,p.current_price,p.CurrencyId,p.qualty,p.alt,p.CreateDate,c.Name AS CN,c.Image\n"

                                . " FROM tblproducts p\n"
                            
                                . " JOIN tblcategory c ON p.CategoryId = c.ID\n"
                            
                                . " WHERE p.Status = 1 AND c.Status=1\n"
                            
                                . " ORDER BY p.CreateDate DESC;";
                                $query = $dbh->prepare($sql); 
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0) {
                                    foreach($results as $result) {
                                ?>
                                <!-- Start Product Default Single Item -->
                                <div class="product-default-single-item product-color--golden swiper-slide">
                                    <div class="image-box">
                                        <a href="product-details-default.php?PID=<?php echo $result->id; ?>" class="image-link">
                                            <img src="<?php echo $DirUPLOADIN_Uploads_File_Products . $result->Icon;?>"
                                                alt="">
                                            <img src="<?php echo $DirUPLOADIN_Uploads_File_Products . $result->Icon;?>"
                                                alt="">
                                        </a>
                                        <div class="action-link">
                                            <div class="action-link-left">
                                                <a><?php 
                                                            if (isset($_SESSION['cart_p_id']) && in_array($result->id, $_SESSION['cart_p_id'])) {
                                                                echo " <a > تمت الاضافة  </a>";
                                                            } else if($result->qualty <= '0') {
                                                                echo " <a> <span style='color:red;'> الكمية نفذة </span> </a>";
                                                            } else {
                                                                echo " <a  href='Add-To-Cart.php?PID=".$result->id."'>إضافة للسلة </a>";
                                                            }
                                                            ?></a>
                                            </div>
                                            <div class="action-link-right">
                                                <!-- <a id="whishstate" class="icon-whishstate"><i
                                                        class="icon-heart"></i></a>
                                                <a data-bs-toggle="modal" data-bs-target="#modalQuickview"><i
                                                        class="icon-magnifier"></i></a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="content-left">
                                            <h6 class="title"><a
                                                    href="product-details-default.php?PID=<?php echo htmlentities($result->id);?>"><?php 
                                                        echo htmlentities($result->CN) ." | ". htmlentities($result->PN);
                                                        ?></a></h6>
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
                                <?php 
                                    } 
                                } 
                                ?>
                            </div>
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