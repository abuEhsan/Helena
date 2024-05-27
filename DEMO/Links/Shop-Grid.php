<div class="shop-section">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row-reverse">
                <div class="col-lg-3">
                    <!-- Start Sidebar Area -->
                    <div class="siderbar-section" data-aos="fade-up" data-aos-delay="0">

                        <!-- Start Single Sidebar Widget -->
                        <?php include("Links/GRID/FILTTER/Widget-Category.php"); ?>
                        <!-- End Single Sidebar Widget -->

                        <!-- Start Single Sidebar Widget -->
                        <?php include("Links/GRID/FILTTER/Widget-Price.php"); ?>
                        <!-- End Single Sidebar Widget -->

                        <!-- Start Single Sidebar Widget -->
                        <?php include("Links/GRID/FILTTER/Widget-Manufacturer.php"); ?>
                        <!-- End Single Sidebar Widget -->

                        <!-- Start Single Sidebar Widget -->
                        <?php include("Links/GRID/FILTTER/Widget-Color.php"); ?>
                        <!-- End Single Sidebar Widget -->

                        <!-- Start Single Sidebar Widget -->
                        <?php include("Links/GRID/FILTTER/Widget-Tag-Product.php"); ?>
                        <!-- End Single Sidebar Widget -->

                        <!-- Start Single Sidebar Widget -->
                        <?php include("Links/GRID/FILTTER/Widget-Tag-Banar.php"); ?>
                        <!-- End Single Sidebar Widget -->

                    </div> 
                    <!-- End Sidebar Area -->
                </div>
                <div class="col-lg-9">
                    <!-- Start Shop Product Sorting Section -->
                    <?php include("Links/GRID/SORT/Button-Sort.php"); ?> 
                    <!-- End Section Content -->

                    <!-- Start Tab Wrapper -->
                    <?php include("Links/GRID/View-Sort.php"); ?> 
                     <!-- End Tab Wrapper -->

                    <!-- Start Pagination -->
                    <?php include("Links/GRID/Pagination-Button.php"); ?> 
                   <!-- End Pagination -->
                </div>
            </div>
        </div>
    </div>