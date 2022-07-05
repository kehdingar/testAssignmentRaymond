<?php


require_once "Session.php";
require_once "Product.php";
require_once "ProductController.php";
require_once "DVDDisc.php";
require_once "Book.php";
require_once "Furniture.php";
Session::start();

$pageTitle = "Add Product";
require_once "includes/header.php";

var_dump(isset($_SESSION['errors']));


?>
<form class="logregform" method="POST" action="">

<header>
    <p><?php echo "Product Add" ?></p>
    <div id="rightMenu">
        <button type="submit" class="save add">SAVE</button>
    <a href="list-products.php" class="mass-delete">CANCEL</a>
    </div>
</header>

<div class="products">

        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <label>SKU</label>
                    <input type="text" name="sku" id="sku" value="" class="form-control">
                </div>
                <p id="skuError" class="error">
                    <?= Validator::getErrorForField('sku') ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <label>Name</label>
                    <input type="text" name="name" id="name" value="" class="form-control">
                </div>
                <p id="nameError" class="error">
                    <?= Validator::getErrorForField('name') ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <label>Price ($)</label>
                    <input type="number" name="price" id="price" value="" class="form-control">
                </div>
                <p id="priceError" class="error">
                    <?= Validator::getErrorForField('price') ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <label>Type Switcher</label>
                    <select id="productType" name="type">
                        <option value="">Type Switcher</option>

                        <?php
   
                        foreach (Product::getChildren() as $type) 
                        {
                             ?>
                              <option value="<?php echo $type?>"><?php echo call_user_func($type. "::getDisplayName"); ?></option>
                        <?php 
                        }
                        ?>
                    </select>
                </div>
                <p id="typeError" class="error">
                    <?= Validator::getErrorForField('type') ?>
                </p>
            </div>
        </div>
        <div id="productHTML">
        </div>
        <small id="productInfo"></small>   
    </form>

</div>

</div>
<?php

require_once "includes/footer.php";
?>