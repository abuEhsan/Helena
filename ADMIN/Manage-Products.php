<?php
session_start();
include('Link/error-reporting.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION["ADMIN_LOGGED_IN"]) || $_SESSION["ADMIN_LOGGED_IN"] !== true) {
    header("Location: index.php");
    exit;
} else {
    include('Link/config.php');
    include('Link/Setting.php');
    include("Link/Dir.php");
    include("Link/Favicons.php");
    // include("Link/languge.php"); 

    $msg = "";
    $errors = [];

    // حجب المنتج
    if (isset($_GET['block'])) {
        $pra = $_GET['block'];
        $sql = "UPDATE tblproducts SET Status = 0 WHERE ID = :block";
        $query = $dbh->prepare($sql);
        $query->bindParam(':block', $pra, PDO::PARAM_STR);
        $query->execute();
        if ($query) {
            $msg = "تم تحديث بيانات السجل بنجاح";
        } else {
            $errors[] = "المعذرة، يرجى المحاولة مرة أخرى";
        }
    }

    // عرض المنتج
    if (isset($_GET['unblock'])) {
        $pra = $_GET['unblock'];
        $sql = "UPDATE tblproducts SET Status = 1 WHERE ID = :unblock";
        $query = $dbh->prepare($sql);
        $query->bindParam(':unblock', $pra, PDO::PARAM_STR);
        $query->execute();
        if ($query) {
            $msg = "تم تحديث بيانات السجل بنجاح";
        } else {
            $errors[] = "المعذرة، يرجى المحاولة مرة أخرى";
        }
    }

    // حذف المنتج
    if (isset($_GET['proid'])) {
        $id = intval($_GET['proid']);
        $sql = "DELETE FROM tblproducts WHERE id = :proid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':proid', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query) {
            $msg = "تم حذف المنتج بنجاح";
        } else {
            $errors[] = "المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title><?php echo $CNAME . " || " . "إدارة المنتجات"; ?></title>
    <!-- Favicons -->
    <link href="<?php echo $FAVICONS; ?>" rel="icon">
    <link href="<?php echo $FAVICONS; ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!--<link href="assets/css/style-arabic.css" rel="stylesheet">-->

    <style>
        body {
            font-family: 'Cairo';
        }
        h1, h2, h3, h4, h5, h6, ul, li, ol, label, input, a {
            font-family: 'Cairo';
        }
        .img-file {
            width: 70px;
            height: 70px;
            border-radius: 6px;
            margin: 2%;
        }
    </style>
</head>
<body>

    <!-- ======= Header ======= -->
    <?php include("Link/header.php"); ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php include("Link/sidebar.php"); ?>
    <!-- End Sidebar -->

    <main id="main" class="main">
        <?php if ($msg): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-1"></i><?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="pagetitle">
            <h1><?php echo "إدارة المنتجات"; ?></h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo "بيانات المنتجات"; ?></h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">المنتج</th>
                                        <th scope="col">ايقونة المنتج</th>
                                        <th scope="col"><?php echo "السعر"; ?></th>
                                        <th scope="col">كمية المخزون</th>
                                        <th scope="col">حالة العرض</th>
                                        <th scope="col">تحديث العرض</th>
                                        <th scope="col">تحديث البيانات</th>
                                        <th scope="col">حذف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sql = "SELECT p.id, p.Name AS PN, p.price, p.CurrencyId, p.qualty, p.Icon, p.typeIcon, p.Status, p.CreateDate, p.LastUpdateDate, c.Name AS CN FROM tblproducts p JOIN tblcategory c ON p.CategoryId = c.ID";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { 
                                            $DateResult = $result->CreateDate;
                                            $currentDate = new DateTime($DateResult);
                                            $DR = $currentDate->format('Y-M-j');
                                            
                                            // Format Text About
                                            $FormatStr = isset($result->about) ? substr(strip_tags($result->about), 0, 200) : "لا يوجد وصف";
                                    ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($result->PN) . " - " . htmlentities($result->CN); ?></td>
                                        <td>
                                            <?php 
                                            if ($result->typeIcon == '1') {
                                                echo $result->Icon ? "<img class='img-file' src='".$DirUPLOADIN_Uploads_File_Products.$result->Icon."'>" : "<img class='img-file' src='".$DirUPLOADIN_Uploads_File_Products."/defult-icon.png'>";
                                            } else {
                                                echo "Video";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            $sql2 = "SELECT Name FROM tblcurrncy WHERE ID = :currencyId";
                                            $query2 = $dbh->prepare($sql2);
                                            $query2->bindParam(':currencyId', $result->CurrencyId, PDO::PARAM_INT);
                                            $query2->execute();
                                            $currency = $query2->fetch();
                                            echo htmlentities($result->price) . " " . htmlentities($currency['Name']);
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            echo $result->qualty >= '1' ? "<span style='color:green'> متوفر ( {$result->qualty} )</span>" : "<span style='color:red'> نفذة الكمية </span>";
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            echo $result->Status == '1' ? "يتم عرضه في الموقع" : "لا يتم عرضه في الموقع";
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($result->Status == '1'): ?>
                                                <a href="Manage-Products.php?block=<?php echo htmlentities($result->id); ?>"><i class="bi bi-check-lg" title="تحديث السجل" onClick="return confirm('هل انت متأكد!');"></i></a>
                                            <?php else: ?>
                                                <a href="Manage-Products.php?unblock=<?php echo htmlentities($result->id); ?>"><i class="bi bi-x" title="تحديث السجل" onClick="return confirm('هل انت متأكد!');"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="Edit-Products.php?Eproid=<?php echo htmlentities($result->id); ?>"><i class="bi bi-pencil-fill" title="تحديث المنتج"></i></a>
                                        </td>
                                        <td>
                                            <a href="Manage-Products.php?proid=<?php echo htmlentities($result->id); ?>"><i class="bi bi-trash-fill" title="حذف السجل" onClick="return confirm('هل أنت متأكد من الحذف!');"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                        $cnt++;
                                        }
                                    } 
                                    ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include("Link/sidebar.php"); ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>
</html>
<?php } ?>
