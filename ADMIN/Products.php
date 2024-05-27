<?php
session_start();
include('Link/error-reporting.php');
if(!isset($_SESSION["ADMIN_LOGGED_IN"]) && $_SESSION["ADMIN_LOGGED_IN"] !== true){
   header("Location: index.php"); 
    exit;

}else{ 
        include('Link/config.php');
        include('Link/Setting.php');
        include("Link/Dir.php"); 
        include("Link/Favicons.php");
//        include("Link/languge.php"); 


        // submit this page
        if(isset($_POST['submit'])) {
            try {
              $dbh->beginTransaction();
      
              // تحميل الأيقونة
              if (!empty($_FILES["Icon"]["name"])) {
                  $target_dir = $DirUPLOADIN_Uploads_File_Products;
                  $file_extension = pathinfo($_FILES["Icon"]["name"], PATHINFO_EXTENSION); // استخراج امتداد الملف
                  $unique_name = uniqid() . '_' . time() . '.' . $file_extension; // اسم ملف فريد
                  $target_file = $target_dir . $unique_name;
                  if (!move_uploaded_file($_FILES["Icon"]["tmp_name"], $target_file)) {
                      throw new Exception("فشل في تحميل الأيقونة.");
                  }
                  $Iconfile = $unique_name; // اسم الملف الجديد بعد التعديل
              }
        
                $PCA = $_POST['CA'];    
                $PNA = $_POST['NA'];
                $PABU = $_POST['ABU'];
                $PPR = $_POST['PR'];
                $PCUR = $_POST['CUR'];
                $PQTY = $_POST['QTY'];
                // $PGR = $_POST['GR'];
              //   $PSS = $_POST['SS'];
        
                // تحقق من وجود المنتج
                $sql = "SELECT ID FROM `tblproducts` WHERE CategoryId=:CA AND Name=:NA";
                $query = $dbh->prepare($sql);
                $query->bindParam(':CA', $PCA, PDO::PARAM_INT);
                $query->bindParam(':NA', $PNA, PDO::PARAM_STR);
                $query->execute();
                
                if ($query->rowCount() > 0) {
                    throw new Exception("المعذرة، هذا الصنف موجود مسبقًا في قاعدة البيانات.");
                }
        
                // إدخال المنتج
                $sql = "INSERT INTO `tblproducts`(`CategoryId`, `AdminId`, `Name`, `Icon`, `about`,  `price`, `CurrencyId`, `qualty`, `typeIcon`, `alt`,`totalview`) 
                        VALUES (:CA, :AdminId, :NA, :Icon, :ABU,:PR, :CUR, :QTY,1, :NA,0)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':CA', $PCA, PDO::PARAM_INT);
                $query->bindParam(':AdminId', $_SESSION['ADMIN_ID'], PDO::PARAM_INT);
                $query->bindParam(':NA', $PNA, PDO::PARAM_STR);
                $query->bindParam(':Icon', $Iconfile, PDO::PARAM_STR);
                $query->bindParam(':ABU', $PABU, PDO::PARAM_STR);
                $query->bindParam(':PR', $PPR, PDO::PARAM_STR);
                $query->bindParam(':CUR', $PCUR, PDO::PARAM_STR);
                $query->bindParam(':QTY', $PQTY, PDO::PARAM_INT);
                // $query->bindParam(':GR', $PGR, PDO::PARAM_INT);
      
                $query->execute();
                
                $lastInsertId = $dbh->lastInsertId();
                if (!$lastInsertId) {
                    throw new Exception("المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!");
                }
        
                // تحميل الصور الأخرى
                // $target_dils_dir='UPLOADING/Uploads-Files-Products/Details/';
                $c = count($_FILES['Images']['name']);
                if ($c < 10) {
                    for ($i = 0; $i < $c; $i++) {
                        $img_extension = pathinfo($_FILES['Images']['name'][$i], PATHINFO_EXTENSION);
                        $unique_img_name = uniqid() . '_' . time() . '_' . $i . '.' . $img_extension;
                        if (!move_uploaded_file($_FILES['Images']['tmp_name'][$i], "UPLOADING/Uploads-Files-Products/Details/" . $unique_img_name)) {
                            throw new Exception("فشل في تحميل الصورة رقم " . ($i + 1) . ".");
                        }
                        // استخدام اسم الملف الجديد في قاعدة البيانات
                        $sql = "INSERT INTO tbldetailsImages(Images, proid) VALUES (:img_name, :proid)";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':img_name', $unique_img_name, PDO::PARAM_STR);
                        $query->bindParam(':proid', $lastInsertId, PDO::PARAM_INT);
                        $query->execute();
                    }
                } else {
                    throw new Exception("بلغت الحد الأقصى لعملية تحميل الملفات.");
                }
                
        
                // // إضافة الألوان
                // if (isset($_POST['COL'])) {
                //     foreach ($_POST['COL'] as $value) {
                //         $sql = "INSERT INTO tblcolor (CID, PID) VALUES (:CID, :PID)";
                //         $query = $dbh->prepare($sql);
                //         $query->bindParam(':CID', $value, PDO::PARAM_INT);
                //         $query->bindParam(':PID', $lastInsertId, PDO::PARAM_INT);
                //         $query->execute();
                //     }
                // }
        
                // // إضافة الأحجام
                // if (isset($_POST['SIZ'])) {
                //     foreach ($_POST['SIZ'] as $value) {
                //         $sql = "INSERT INTO tblsize (SID, PID) VALUES (:SID, :PID)";
                //         $query = $dbh->prepare($sql);
                //         $query->bindParam(':SID', $value, PDO::PARAM_INT);
                //         $query->bindParam(':PID', $lastInsertId, PDO::PARAM_INT);
                //         $query->execute();
                //     }
                // }
        
                $dbh->commit();
                $msg = "تم إضافة الملف بنجاح";
            } catch (Exception $e) {
                $dbh->rollBack();
                $erorr = $e->getMessage();
            }
        }
        
      
           // Update Category  Block 
             if(isset($_GET['block']))
            {
 
                $pra=$_GET['block'];
                $sql="update tblproducts  set Status=0 where ID=:block "; 
                $query = $dbh->prepare($sql);
                $query->bindParam(':block',$pra,PDO::PARAM_STR);
                $query->execute();
                  if($query){
                      $msg="تم تحديث بيانات السجل بنجاح";  
                    }else{
                        $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
                    }
            }
        
           // Update Classification  unBlock 
             if(isset($_GET['unblock']))
            {
           
                $pra=$_GET['unblock'];
                $sql="update tblproducts  set Status=1 where ID=:unblock "; 
                $query = $dbh->prepare($sql);
                $query->bindParam(':unblock',$pra,PDO::PARAM_STR);
                $query->execute();
                  if($query){
                       $msg="تم تحديث بيانات السجل بنجاح";   
                    }else{
                        $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
                    }
            }

     //delete 
        if(isset($_GET['proid']))
        {
            $id=intval($_GET['proid']);
            $sql="delete from tblproducts where id=:proid ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':proid',$id,PDO::PARAM_INT);
            $query->execute();
            if($query){
              $msg="تم حذف المنتج بنجاح";  
            }else{
               $erorr="المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!";  
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
    <title> <?php echo $CNAME." || "."    إدارة المنتجات  " ;?> </title>
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
    <!--<link href="assets/css/style-arabic.css" rel="stylesheet">-->

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

    <!-- ======= Header ======= -->
    <?php include("Link/header.php"); ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php include("Link/sidebar.php"); ?>
    <!-- End Sidebar-->

    <main id="main" class="main">
        <?php if($msg){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <?php echo $msg;?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } if($erorr){ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            <?php echo $erorr; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>
        <div class="pagetitle">
            <h1> <?php echo "إضافة منتجات"; ?> </h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo "أدخل بيانات المنتج"; ?> </h5>

                            <!-- General Form Elements -->
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"><?php echo " الصنف";?></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="CA"
                                            required>
                                            <option value="">حدد الصنف </option>
                                            <?php $sql = "SELECT ID,Name from tblcategory";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
                                            <option value="<?php echo htmlentities($result->ID); ?>">
                                                <?php echo htmlentities($result->Name); ?></option>
                                            <?php }}else{ echo "<option>"."لا توجد اصناف "."</option>"; } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">
                                        <?php echo "إسم المنتج"; ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="NA" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber"
                                        class="col-sm-2 col-form-label"><?php echo "أيقونة المنتج"; ?> </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile" name="Icon">
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="inputNumber"
                                        class="col-sm-2 col-form-label"><?php echo "صور أخرى للمنتج "; ?> </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile" name="Images[]" multiple>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">
                                        <?php echo "حول المنتج "; ?></label>
                                    <div class="col-sm-10">
                                        <did class="textarea">
                                            <!--                          <textarea class="tinymce-editor" name="ABU" >-->
                                            <textarea class="form-control" name="ABU" dir="rtl"></textarea>
                                        </did>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo "سعر المنتج"; ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="validationDefault02" value="0"
                                            name="PR" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"><?php echo " العملة";?></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="CUR"
                                            required>
                                            <option value="">يرجى تحديد العملة</option>
                                            <?php $sql = "SELECT ID,Name from tblcurrncy";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   
    if($result->ID == 2 ){
        echo "<option value='".$result->ID."' >" .$result->Name. "</option>";
    }else{
        echo "<option value='".$result->ID."'disabled >" .$result->Name. "</option>"; 
    }               
?>
                                            <!--<option value="<?php echo htmlentities($result->ID); ?>" style=""><?php echo htmlentities($result->Name); ?></option>-->
                                            <?php }}else{ echo "<option>"."لا توجد عملات "."</option>"; } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputNumber"
                                        class="col-sm-2 col-form-label"><?php echo " كمية المنتج"; ?> </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="validationDefault02" value="0"
                                            name="QTY">
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary" name="submit">
                                            <?php echo "إتمام"; ?></button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>



            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo "بيانات المنتجات";?></h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><?php echo "  المنتج";?></th>
                                        <th scope="col"><?php echo " ايقونة المنتج";?></th>
                                        <!--
                    <th scope="col"><?php echo "حول المنتج";?></th>
                    <th scope="col"><?php echo " مدخل البيانات";?></th>
                    <th scope="col"><?php echo "عدد المعاينة";?></th>
-->
                                        <th scope="col"><?php echo "<?php echo $LANG->WORD80; ?>";?></th>
                                        <!--                    <th scope="col"><?php echo "تاريخ الرفع ";?></th>-->
                                        <th scope="col"><?php echo "كمية المخزون";?></th>
                                        <th scope="col"><?php echo "حالة العرض";?></th>
                                        <th scope="col"><?php echo "تحديث العرض";?></th>
                                        <th scope="col"><?php echo "تحديث البيانات ";?></th>
                                        <th scope="col"> <?php echo "حذف";?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
$sql = "SELECT p.id,p.Name AS PN,p.price,p.CurrencyId,p.qualty,p.Icon,p.typeIcon,p.Status,p.CreateDate,p.LastUpdateDate,c.Name AS CN  FROM tblproducts p\n"

    . "JOIN tblcategory c\n"

    . "ON p.CategoryId=c.ID";

 
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
    $DateResult=$result->CreateDate;
    $currentDate = new DateTime($DateResult);
    $DR=$currentDate->format('Y-M-j');
    
       // Format Text About
    // مثال على كود أكبر حيث يتم التحقق من وجود الخاصية about في كائن $result
    if (isset($result->about) && $result->about != null) {
        // إزالة أي علامات HTML وأخذ أول 200 حرف
        $FormatStr = substr(strip_tags($result->about), 0, 200);
    } else {
        $FormatStr = "لا يوجد وصف";
    }
    
?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($result->PN) ." - ".htmlentities($result->CN); ?>
                                        </td>
                                        <td><?php 
if($result->typeIcon == '1'){
    
   if($result->Icon){
    echo"<img class='img-file'   src='".$DirUPLOADIN_Uploads_File_Products.$result->Icon."'>"."</img>";
    }else{
        echo"<img class='img-file'   src='".$DirUPLOADIN_Uploads_File_Products."/defult-icon.png'>"."</img>";
    } 
}else{
    echo"Video";
}

    
                                                        ?></td>

                                        <td><?php 
$sql2 = "SELECT Name from tblcurrncy WHERE ID ='$result->CurrencyId' ";
$query = $dbh->prepare($sql2);
$query->execute();
$results2=$query->fetch();
echo htmlentities($result->price)." ".$results2['Name'];
                                                           
                                                           ?></td>
                                        <td><?php 
if($result->qualty >= '1'){
    echo "<span style='color:green'> متوفر ( {$result->qualty} )</span>" ;
}else{
    echo"<span style='color:red'>  نفذة الكمية </span>";
}

    
                                                        ?></td>
                                        <td><?php 
if($result->Status == '1'){
    echo"يتم عرضه في الموقع";
}else{
    echo"لا يتم عرضه في الموقع";
}

    
                                                        ?></td>
                                        <?php if($result->Status == '1'){ ?>

                                        <td>
                                            <a href="Products.php?block=<?php echo htmlentities($result->id);?>"><i
                                                    class="bi bi-check-lg" title="<?php echo "تحديث السجل";?>"
                                                    onClick="return confirm('<?php echo "هل انت متأكد!";?>');"></i> </a>
                                        </td>
                                        <?php }else{ ?>


                                        <td>
                                            <a href="Products.php?unblock=<?php echo htmlentities($result->id);?>"><i
                                                    class="bi bi-x" title="<?php echo "تحديث السجل";?>"
                                                    onClick="return confirm('<?php echo "هل انت متأكد!";?>');"></i> </a>
                                        </td>
                                        <?php } ?>
                                        <td>
                                            <a href="Edit-Products.php?Eproid=<?php echo htmlentities($result->id);?>"><i
                                                    class="bi bi-pencil-fill" title="<?php echo "تحديث المنتج";?>"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="Products.php?proid=<?php echo htmlentities($result->id);?>"><i
                                                    class="bi bi-trash-fill" title="<?php echo "حذف السجل";?> "
                                                    onClick="return confirm('<?php echo "هل أنت متأكد من الحذف!";?>');"></i>
                                            </a>

                                        </td>
                                    </tr>

                                    <?php $cnt=$cnt+1;}} ?>
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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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