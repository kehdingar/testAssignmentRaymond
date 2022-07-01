<?php


require_once "Product.php";
require_once "DVDDisc.php";
require_once "Book.php";
require_once "Furniture.php";

$pageTitle = "Add Product";
require_once "includes/header.php";
$strr = "BookStore";



?>
<header>
    <p><?php echo "Product Add" ?></p>
    <div id="rightMenu">
        <a href="#" class="add">SAVE</a>
        <a href="list-products.php" class="mass-delete">CANCEL</a>
    </div>
</header>

<div class="products">
    <form class="logregform" method="POST">

        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <label>SKU</label>
                    <input type="text" name="sku" id="#sku" value="" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <label>Name</label>
                    <input type="text" name="name" id="name" value="" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <label>Price</label>
                    <input type="number" name="price" id="price" value="" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <label>Type Switcher</label>
                    <select id="productType" name="switcher[]">
                        <option>Type Switcher</option>

                        <?php

                        foreach (get_declared_classes() as $type) 
                        {
                            if (is_subclass_of($type, 'Product')) { ?>
                                <option><?php echo call_user_func($type. "::getFrontEndName"); ?></option>
                        <?php }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </form>

</div>


<?php
require_once "includes/footer.php";
?>