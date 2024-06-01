<?php
session_start();
include('Link/error-reporting.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION["ADMIN_LOGGED_IN"]) || $_SESSION["ADMIN_LOGGED_IN"] !== true) {
    header("Location: index.php");
    exit;
}

include('Link/config.php');
include('Link/Setting.php');
include("Link/Dir.php");
include("Link/Favicons.php");

// معالجة إرسال النموذج
if (isset($_POST['submit'])) {
    try {
        $dbh->beginTransaction();

        // التحقق من الحقول المطلوبة
        $requiredFields = ['CA', 'NA', 'ABU', 'PR', 'CUR', 'QTY'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("الرجاء تعبئة الحقل: " . $field);
            }
        }

        // مسار تحميل الأيقونة
        $Iconfile = null;
        if (!empty($_FILES["Icon"]["name"])) {
            $target_dir = $DirUPLOADIN_Uploads_File_Products;
            $file_extension = pathinfo($_FILES["Icon"]["name"], PATHINFO_EXTENSION);
            $unique_name = uniqid() . '_' . time() . '.' . $file_extension;
            $target_file = $target_dir . $unique_name;

            // التحقق من أنواع الملفات المسموح بها
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($file_extension, $allowed_extensions)) {
                throw new Exception("امتداد الملف غير مسموح به.");
            }

            // التحقق من حجم الملف (5 ميجا بايت كحد أقصى)
            if ($_FILES["Icon"]["size"] > 5242880) {
                throw new Exception("حجم الملف كبير جدا.");
            }

            if (!move_uploaded_file($_FILES["Icon"]["tmp_name"], $target_file)) {
                throw new Exception("فشل في تحميل الأيقونة.");
            }
            $Iconfile = $unique_name;
        }

        // تعيين المتغيرات
        $PCA = $_POST['CA'];
        $PNA = $_POST['NA'];
        $PABU = $_POST['ABU'];
        $PPR = $_POST['PR'];
        $PCUR = $_POST['CUR'];
        $PQTY = $_POST['QTY'];

        // تحقق من وجود المنتج
        $sql = "SELECT ID FROM tblproducts WHERE CategoryId=:CA AND Name=:NA";
        $query = $dbh->prepare($sql);
        $query->bindParam(':CA', $PCA, PDO::PARAM_INT);
        $query->bindParam(':NA', $PNA, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            throw new Exception("المعذرة، هذا الصنف موجود مسبقًا في قاعدة البيانات.");
        }

        // إدخال المنتج
        $sql = "INSERT INTO tblproducts (CategoryId, AdminId, Name, Icon, about, price, CurrencyId, qualty, typeIcon, alt, totalview) 
                VALUES (:CA, :AdminId, :NA, :Icon, :ABU, :PR, :CUR, :QTY, 1, :NA, 0)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':CA', $PCA, PDO::PARAM_INT);
        $query->bindParam(':AdminId', $_SESSION['ADMIN_ID'], PDO::PARAM_INT);
        $query->bindParam(':NA', $PNA, PDO::PARAM_STR);
        $query->bindParam(':Icon', $Iconfile, PDO::PARAM_STR);
        $query->bindParam(':ABU', $PABU, PDO::PARAM_STR);
        $query->bindParam(':PR', $PPR, PDO::PARAM_STR);
        $query->bindParam(':CUR', $PCUR, PDO::PARAM_INT);
        $query->bindParam(':QTY', $PQTY, PDO::PARAM_INT);
        $query->execute();

        $lastInsertId = $dbh->lastInsertId();
        if (!$lastInsertId) {
            throw new Exception("المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!");
        }

        // تحميل الصور الأخرى
        $c = count($_FILES['Images']['name']);
        if ($c < 10) {
            for ($i = 0; $i < $c; $i++) {
                $img_extension = pathinfo($_FILES['Images']['name'][$i], PATHINFO_EXTENSION);
                $unique_img_name = uniqid() . '_' . time() . '_' . $i . '.' . $img_extension;

                // التحقق من أنواع الملفات المسموح بها
                if (!in_array($img_extension, $allowed_extensions)) {
                    throw new Exception("امتداد الملف غير مسموح به للصورة رقم " . ($i + 1) . ".");
                }

                // التحقق من حجم الملف
                if ($_FILES['Images']['size'][$i] > 5242880) {
                    throw new Exception("حجم الملف كبير جدا للصورة رقم " . ($i + 1) ..");
                }

                if (!move_uploaded_file($_FILES['Images']['tmp_name'][$i], "UPLOADING/Uploads-Files-Products/Details/" . $unique_img_name)) {
                    throw new Exception("فشل في تحميل الصورة رقم " . ($i + 1) . ".");
                }

                // استخدام اسم الملف الجديد في قاعدة البيانات
                $sql = "INSERT INTO tbldetailsimages (Images, proid) VALUES (:img_name, :proid)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':img_name', $unique_img_name, PDO::PARAM_STR);
                $query->bindParam(':proid', $lastInsertId, PDO::PARAM_INT);
                $query->execute();
            }
        } else {
            throw new Exception("بلغت الحد الأقصى لعملية تحميل الملفات.");
        }

        $dbh->commit();
        $msg = "تم إضافة الملف بنجاح";
    } catch (Exception $e) {
        $dbh->rollBack();
        $error = $e->getMessage();
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
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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

    <style>
    body {
        font-family: 'Cairo';
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    ul,
    li,
    ol,
    label,
    input,
    a {
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
    <!-- Header -->
    <?php include("Link/header.php"); ?>
    <!-- End Header -->

    <!-- Sidebar -->
    <?php include("Link/sidebar.php"); ?>
    <!-- End Sidebar -->

    <main id="main" class="main">
        <?php if (isset($msg)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>

        <?php if (isset($error)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>

        <div class="pagetitle">
            <h1>إدارة المنتجات</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
                    <li class="breadcrumb-item">المنتجات</li>
                    <li class="breadcrumb-item active">إضافة منتج</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">إضافة منتج جديد</h5>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="inputCategory" class="col-sm-2 col-form-label">الفئة</label>
                                    <div class="col-sm-10">
                                        <select id="inputCategory" name="CA" class="form-select" required>
                                            <option value="">اختر فئة...</option>
                                            <?php  
                                                        $sql = "SELECT ID, Name FROM tblcategory";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                        if ($query->rowCount() > 0):
                                                            foreach ($results as $result):
                                                                echo '<option value="' . htmlentities($result->ID) . '">' . htmlentities($result->Name) . '</option>';
                                                            endforeach;
                                                        else:
                                                            echo '<option>' . 'لا توجد اصناف ' . '</option>'; 
                                                        endif;
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputName" class="col-sm-2 col-form-label">اسم المنتج</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="inputName" name="NA" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputAbout" class="col-sm-2 col-form-label">الوصف</label>
                                    <div class="col-sm-10">
                                        <textarea id="inputAbout" name="ABU" class="form-control" rows="3"
                                            required></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPrice" class="col-sm-2 col-form-label">السعر</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="inputPrice" name="PR" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputCurrency" class="col-sm-2 col-form-label">العملة</label>
                                    <div class="col-sm-10">
                                        <select id="inputCurrency" name="CUR" class="form-select" required>
                                            <option value="">اختر العملة...</option><?php 
                                                $sql = "SELECT ID,Name from tblcurrncy WHERE ID=2";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                if($query->rowCount() > 0)
                                                {
                                                    foreach($results as $result)
                                                    {   
                                                        echo "<option value='".$result->ID."' >" .$result->Name. "</option>";
                                                    }
                                                }            
?>
                                            <!-- هنا يمكنك إدراج خيارات العملات من قاعدة البيانات -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputQuantity" class="col-sm-2 col-form-label">الكمية</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="inputQuantity" name="QTY" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputIcon" class="col-sm-2 col-form-label">الأيقونة</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="inputIcon" name="Icon" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputImages" class="col-sm-2 col-form-label">صور المنتج</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="inputImages" name="Images[]" class="form-control"
                                            multiple>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">إضافة المنتج</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- End Recent Sales -->
            </div>
        </section>
    </main><!-- End #main -->

    <!-- Footer -->
    <?php include("Link/footer.php"); ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

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
