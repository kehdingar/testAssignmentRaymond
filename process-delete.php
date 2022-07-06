<?php
require_once "ProductController.php";
require_once "Product.php";



if (isset($_POST['product'])) {
    $productController = new ProductController();
    $productController->setProductIds($_POST['product']);
    $productController->deleteProduct();
    echo json_encode("success");
} else {
    $response = "empty";
    echo json_encode($response);
}
