<?php

$pageTitle = "List Product";
require_once "includes/header.php";
?>
    <header>
        <p><?php echo "Product List" ?></p>
        <div id="rightMenu">
        <a href="add-product.php" class="add">ADD</a>
        <a href="#" class="mass-delete">MASS DELETE</a>
        </div>
    </header>

<div class="products">

</div>


<?php
require_once "includes/footer.php";
?>