<?php
require_once('Links/Setting.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // التحقق من صحة معرف المنتج والكمية
        if (is_numeric($product_id) && is_numeric($quantity) && $quantity > 0) {
            $statement = $dbh->prepare("SELECT * FROM tblproducts WHERE id=?");
            $statement->execute([$product_id]);
            $product = $statement->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $p_name = $product['Name'];
                $price = $product['price'];
                $p_featured_photo = $product['Icon'];

                // تهيئة سلة المشتريات إذا لم تكن مهيأة بالفعل
                if (!isset($_SESSION['cart_p_id'])) {
                    $_SESSION['cart_p_id'] = [];
                    $_SESSION['cart_p_qty'] = [];
                    $_SESSION['cart_p_current_price'] = [];
                    $_SESSION['cart_p_name'] = [];
                    $_SESSION['cart_p_featured_photo'] = [];
                    $_SESSION['couter_items_adds'] = 0;
                }

                $added = false;
                foreach ($_SESSION['cart_p_id'] as $key => $value) {
                    if ($value == $product_id) {
                        $added = true;
                        break;
                    }
                }

                if ($added) {
                    $error_message1 = 'هذا المنتج مضاف مسبقا في السلة';
                } else {
                    $new_key = count($_SESSION['cart_p_id']) + 1;
                    $_SESSION['cart_p_id'][$new_key] = $product_id;
                    $_SESSION['cart_p_qty'][$new_key] = $quantity;
                    $_SESSION['cart_p_current_price'][$new_key] = $price;
                    $_SESSION['cart_p_name'][$new_key] = $p_name;
                    $_SESSION['cart_p_featured_photo'][$new_key] = $p_featured_photo;
                    $_SESSION['couter_items_adds'] += 1;
                    $success_message1 = 'تم إضافة المنتج في السلة بنجاح.';
                }

                if (isset($error_message1)) {
                    echo "<script>alert('" . $error_message1 . "');</script>";
                    header('location: product.php?id=' . $product_id);
                    exit();
                }
                if (isset($success_message1)) {
                    echo "<script>alert('" . $success_message1 . "');</script>";
                    echo "<script type='text/javascript'>document.location = 'product.php?id={$product_id}';</script>";
                }
            } else {
                echo "<script>alert('المنتج غير موجود');</script>";
                header('location: index.php');
                exit();
            }
        } else {
            echo "<script>alert('بيانات غير صالحة');</script>";
            header('location: index.php');
            exit();
        }
    } else {
        echo "<script>alert('بيانات غير مكتملة');</script>";
        header('location: index.php');
        exit();
    }
} else {
    header('location: index.php');
    exit();
}
?>
