<?php

require_once "Session.php";
require_once "Product.php";
require_once "ProductController.php";
require_once "DVD.php";
require_once "Book.php";
require_once "Furniture.php";
Session::start();

$pageTitle = "Add Product";
require_once "includes/header.php";

?>

<header>
    <span><?php echo "Product Add" ?></span>
    <div id="rightMenu">
        <button class="save button-one">Save</button>
        <a href="list-products.php" class="button-two">Cancel</a>
    </div>
</header>

<div class="add-product prodcut-area">

    <form id="product_form" method="POST">
        <div class="form-group row">
            <label class="col-md-1 col-form-label">SKU</label>
            <div class="col-md-4">
                <input type="text" name="sku" id="sku" value="" class="form-control">
            </div>
            <p id="skuError" class="error">
                <?= Validator::getErrorForField('sku') ?>
            </p>
        </div>

        <div class="form-group row">
            <label class="col-md-1 col-form-label">Name</label>
            <div class="col-md-4">
                <input type="text" name="name" id="name" value="" class="form-control">
            </div>
            <p id="nameError" class="error">
                <?= Validator::getErrorForField('name') ?>
            </p>
        </div>

        <div class="form-group row">
            <label class="col-md-1 col-form-label">Price ($)</label>
            <div class="col-md-4">
                <input type="number" name="price" id="price" value="" class="form-control">
            </div>

            <p id="priceError" class="error ">
                <?= Validator::getErrorForField('price') ?>
            </p>
        </div>

        <div class="input-group mb-8">
            <div class="input-group-prepend">
                <label class="input-group-text" for="productType">Type Switcher</label>
            </div>

            <div class="col-md-4">
                <select class="custom-select form-control" id="productType" name="type">
                    <option value="">Type Switcher</option>

                    <?php

                    foreach (Product::getChildren() as $type) {
                    ?>
                        <option value="<?php echo $type ?>"><?php echo call_user_func($type . "::getDisplayName"); ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <p id="typeError" class="error">
            <?= Validator::getErrorForField('type') ?>
        </p>

        <div id="productHTML">
        </div>
        <small id="productInfo" style="font-weight: bold;"></small>
    </form>

</div>

</div>
<?php

require_once "includes/footer.php";
