<?php
require_once "Product.php";
require_once "DVDDisc.php";
// require_once "Book.php";
require_once "Furniture.php";
require_once "includes/header.php";
$pageTitle = "Add Product";
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
                                <?php 
                                     foreach(get_declared_classes() as $type)
                                     {
                                        if($type instanceof Product){

                                            var_dump($type);
                                        }

                                     }
                                    ?>
                                    <label>Type Switcher</label>
                                    <select id="productType" name="switcher[]">
                                    <option>Type Switcher</option>


                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

</div>


<?php
require_once "includes/footer.php";
?>