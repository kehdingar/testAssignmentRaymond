<?php
require_once "ProductController.php";
require_once "Product.php";



if (isset($_POST['product'])) {
    $productController = new ProductController();
    $productController->setProductIds($_POST['product']);
    $productController->deleteProduct();
    $crud = new Crud();
    $row = $crud->read("SELECT * FROM product LIMIT 1");
    $response = [];
    if($row){

        echo json_encode("data");
    }else{

        echo json_encode("nodata");
    }
} else {
    $response = "empty";
    echo json_encode($response);
}
