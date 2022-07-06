<?php
require_once "ProductController.php";
require_once "Session.php";
require_once "DVD.php";
require_once "Furniture.php";
require_once "Book.php";
Session::start();


$productController = new ProductController();

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {

    $productController->addProduct();

    // clearing all errors if page is reloaded
    unset($_SESSION['errors']);
} else {
    if (isset($_GET['selectedType']) && !empty($_GET['selectedType'])) {


        $productController->setType(new $_GET['selectedType']);

        $productType = $productController->getType();
        $html = $productController->getProductHTML();
        $response = ["empty" => false, "html" => $html, "info" => $productController->getDescriptionMessage()];

        echo json_encode($response);
    } else {
        $response = ["empty" => true];
        echo json_encode($response);
    }
}
