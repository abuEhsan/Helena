<?php
session_start();
require_once __DIR__ . "/lib/DataSource.php";
$db_handle = new DataSource();

$query = 'SELECT * FROM tbl_whish_list JOIN tblproduct ON tblproduct.id = tbl_whish_list.product_id ORDER BY tbl_whish_list.product_id ASC';

$whish_array = $db_handle->select($query);
$whish_array_pid = array();
if (! empty($whish_array)) {
    foreach ($whish_array as $z => $value) {
        $whish_array_pid[] = $whish_array[$z]['product_id'];
    }
}
if (! empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (! empty($_POST["quantity"])) {
                $query = 'SELECT * FROM tblproduct WHERE code= ? ';
                $paramType = 's';
                $paramValue = array(
                    $_GET["code"]
                );
                $productByCode = $db_handle->select($query, $paramType, $paramValue);

                $itemArray = array(
                    $productByCode[0]["code"] => array(
                        'name' => $productByCode[0]["name"],
                        'code' => $productByCode[0]["code"],
                        'quantity' => $_POST["quantity"],
                        'price' => $productByCode[0]["price"],
                        'image' => $productByCode[0]["image"]
                    )
                );

                if (! empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["code"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if (! empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
?>
<HTML>
<HEAD>
<TITLE>Simple PHP Shopping Cart</TITLE>
<link href="css/style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
    <div id="shopping-cart">
        <div class="txt-heading">Shopping Cart</div>

        <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
<?php
if (isset($_SESSION["cart_item"])) {
    $total_quantity = 0;
    $total_price = 0;
    ?>
<table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th class="text-left">Name</th>
                    <th class="text-left">Code</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Price</th>
                    <th class="text-center">Remove</th>
                </tr>
<?php
    foreach ($_SESSION["cart_item"] as $item) {
        $item_price = $item["quantity"] * $item["price"];
        ?>
				<tr>
                    <td><img src="<?php echo $item["image"]; ?>"
                        class="cart-item-image" /><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["code"]; ?></td>
                    <td class="text-right"><?php echo $item["quantity"]; ?></td>
                    <td class="text-right"><?php echo "$ ".$item["price"]; ?></td>
                    <td class="text-right"><?php echo "$ ". number_format($item_price,2); ?></td>
                    <td class="text-center"><a
                        href="index.php?action=remove&code=<?php echo $item["code"]; ?>"
                        class="btnRemoveAction"><img
                            src="images/icon-delete.png"
                            alt="Remove Item" /></a></td>
                </tr>
				<?php
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"] * $item["quantity"]);
    }
    ?>

<tr>
                    <td colspan="2" align="right">Total:</td>
                    <td align="right"><?php echo $total_quantity; ?></td>
                    <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
  <?php
} else {
    ?>
<div class="no-records">Your Cart is Empty</div>
<?php
}
?>
</div>

    <div id="product-grid">
        <div class="txt-heading">Products</div>
	<?php
$query = 'SELECT * FROM tblproduct ORDER BY id ASC';
$product_array = $db_handle->select($query);
if (! empty($product_array)) {
    foreach ($product_array as $key => $value) {
        ?>
		<div class="product-item">
            <form method="post"
                action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                <div class="product-image">
                    <img
                        src="<?php echo $product_array[$key]["image"]; ?>">
                </div>
                <div class="product-tile-footer">
                    <div class="product-title"><?php echo $product_array[$key]["name"]; ?>
                    <?php if (in_array($product_array[$key]["id"], $whish_array_pid)) { ?>
                    <span
                            data-pid="<?php echo $product_array[$key]["id"]; ?>"
                            class="heart"
                            onclick="removeFromWishlist(this)"
                            title="Remove from wishlist"> <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24"
                                viewBox="0 0 24 24" fill="none"
                                stroke-width="2" stroke-linecap="round"
                                stroke-line join="round"
                                stroke="currentColor"
                                class="feather feather-heart color-filled">
									<path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg><img
                            src="images/loading.gif" id="loader">
                        </span>
                        <?php } else { ?>
                        <span
                            data-pid="<?php echo $product_array[$key]["id"]; ?>"
                            class="heart" onclick="addToWishlist(this)"
                            title="Add to wishlist"> <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24"
                                viewBox="0 0 24 24" fill="none"
                                stroke-width="2" stroke-linecap="round"
                                stroke-line join="round"
                                stroke="currentColor"
                                class="feather feather-heart">
                                    <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg><img
                            src="images/loading.gif" id="loader">
                        </span>
                        <?php } ?>
					</div>
                    <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                    <div class="cart-action">
                        <input type="text" class="product-quantity"
                            name="quantity" value="1" size="2" /><input
                            type="submit" value="Add to Cart"
                            class="btnAddAction" />
                    </div>
                </div>
            </form>
        </div>
	<?php
    }
}
?>
	</div>
    <div id="shopping-cart">
        <a id="whishlist" href="wishlist.php">Show My Wishlist</a>
    </div>
    <script type="text/javascript" src="vendor/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/wishlist.js"></script>
</BODY>
</HTML>