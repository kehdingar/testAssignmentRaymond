<?php

$pageTitle = "List Product";
require_once "includes/header.php";
require_once "ListProducts.php";
?>
<header>
    <span><?php echo "Product List" ?></span>
    <div id="rightMenu">
        <a href="add-product.php" class="add button-one">ADD</a>
        <a href="#" class="mass-delete button-two" id="delete-product-btn">MASS DELETE</a>

    </div>
</header>

<form id="productListForm" method="POST">
    <div class="products prodcut-area">
        <?php

        $products = new ListProducts();

        $excludedNames = ['sku', 'name', 'price', 'id', 'type'];

        foreach ($products->getProducts() as $column => $product) { ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body product-list">
                    <div>
                        <input class="form-check-input delete-checkbox" type="checkbox" name="product[]" id="checkbox" value="<?php echo $product['id'] ?>" aria-label="...">
                    </div>
                    <p><?php echo $product['sku'] ?></p>
                    <p><?php echo $product['name'] ?></p>
                    <p><?php echo $product['price'] ?></p>
                    <?php
                    foreach ($product as $name => $value) {
                        if ($value != "" && !in_array($name, $excludedNames)) { ?>
                            <p><?php echo ucfirst($name) . " : " . $value; ?></p>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</form>
</div>

</div>
<?php
require_once "includes/footer.php";
