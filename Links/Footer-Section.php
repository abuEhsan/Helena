    <footer class="footer-section footer-bg">
        <div class="footer-wrapper">
            <!-- Start Footer Top -->
            <div class="footer-top">
                <div class="container">
                    <div class="row mb-n6">
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <!-- Start Footer Single Item -->
                            <div class="footer-widget-single-item footer-widget-color--golden" data-aos="fade-up"
                                data-aos-delay="0" >
                                <h4 style="color:white;">روابط مهمة</h4>
                                <ul class="footer-nav">
                                    <li><a href="contact-us.php">تواصل معنا</a></li>
                                     <li><a href="index.php"> المتجر </a></li>
                                    <li><a href="#">سياسة الخصوصية</a></li>
                                     <li><a href="faq.php">الأسئلة الشائعة</a></li>
                                </ul>
                            </div>
                            <!-- End Footer Single Item -->
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <!-- Start Footer Single Item -->
                            <div class="footer-widget-single-item footer-widget-color--golden" data-aos="fade-up"
                                data-aos-delay="200">
                                <h4 style="color:white;">روابط تهمك</h4>
                                <ul class="footer-nav">
                                    <li><a href="Dashborad.php">حسابك</a></li>
<!--                                    <li><a href="wishlist.php">التفضيلات</a>-->
                                    <li><a href="Orders.php">طلباتك</a></li>
                                </ul>
                            </div>
                            <!-- End Footer Single Item -->
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <!-- Start Footer Single Item -->
                            <div class="footer-widget-single-item footer-widget-color--golden" data-aos="fade-up"
                                data-aos-delay="200">
                                <h4 style="color:white;">تواصل معنا</h4>
                                <ul class="footer-nav">
                                    <li dir="ltr"><a href="tel:+<?php echo $phone1; ?>"><?php echo $phone1; ?></a></li>
                                    <li><a href="<?php echo $Email; ?>"><?php echo $Email; ?></a></li>
                                    <li><span><?php echo $ADDRESS; ?></span></li>
                                </ul>
                            </div>
                            <!-- End Footer Single Item -->
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <!-- Start Footer Single Item -->
                            <div class="footer-widget-single-item footer-widget-color--golden" data-aos="fade-up"
                                data-aos-delay="200">
<!--                                <a href="index.php"><img src="<?php echo $DirassetsImage.$ICON; ?>" alt="" width="200"></a>-->
                            </div>
                            <!-- End Footer Single Item -->
                        </div>
                        
                      
                      
                    </div>
                </div>
            </div> 
            <!-- End Footer Top -->
            <!-- Start Footer Center -->
            <div class="footer-center">
                <div class="container">
                    <div class="row mb-n6">
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-6">
                            <div class="footer-social" data-aos="fade-up" data-aos-delay="0">
                                <h4 class="title">عناوين التواصل الاجتماعي</h4>
                                <ul class="footer-social-link" dir="">
                                    <li style='margin-right: 1%;'><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li style='margin-right: 1%;'><a href="https://wa.link/b2zxn7"><i class="fa fa-whatsapp"></i></a></li>
                                    <li style='margin-right: 1%;'><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    
                                    <?php 
//$sql = "SELECT social_url, social_name,social_icon FROM `tblsocial`;";
//$query = $dbh->prepare($sql);
//$query->execute();
//$results=$query->fetchAll(PDO::FETCH_OBJ);
//if($query->rowCount() > 0)
//{
//    foreach($results as $result)
//    {    
//
//         if($result->social_url){
//             echo"<li style='margin-right: 1%;'><a href='{$result->social_url}'><i class='$result->social_icon'></i></a></li>";
//         }
//    }
//}
                                ?></ul>
                            </div>
                        </div>
<!--
                        <div class="col-xl-7 col-lg-6 col-md-6 mb-6">
                            <div class="footer-newsletter" data-aos="fade-up" data-aos-delay="200">
                                <h4 class="title">أشترك معنا بالنشرة الأخبارية</h4>
                                <div class="form-newsletter">
                                    <form action="#" method="post">
                                        <div class="form-fild-newsletter-single-item input-color--golden">
                                            <input type="email" placeholder="" required>
                                            <button type="submit">أشترك</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
-->
                    </div>
                </div>
            </div>
            <!-- Start Footer Center -->

            <!-- Start Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <div
                        class="row justify-content-between align-items-center align-items-center flex-column flex-md-row mb-n6">
                        <div class="col-auto mb-6">
                                <div style="text-align: center;">
<!--
                                    <p><strong>رقم الغرفة التجارية</strong></p>
                                    <p><?php echo $CommercialNumber; ?></p>
-->
                                </div>
                        </div>
                        <div class="col-auto mb-6">
                            <div class="footer-copyright">
                                <p class="copyright-text">&copy; 2023 <a href="index.php">متجر هيلينا</a>

                            </div>
                        </div>
                        <div class="col-auto mb-6">
                            <div class="footer-payment">
                                <div class="image">
                                    <img src="assets/images/company-logo/payment.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Footer Bottom -->
        </div>
    </footer>