<?php
include_once "Crud.php";
require_once "Product.php";
require_once "DVD.php";
require_once "Book.php";

class ListProducts
{
    private $queryResults;
    private $crud;

    public function __construct()
    {
        $this->crud = new Crud();
        $this->queryResults = $this->queryProducts();
    }

    public function queryProducts()
    {
        $book = new Book();
        $dvdDisc = new DVD();

        $weightUnit = $book->getWeightUnit();
        $sizeUnit = $dvdDisc->getSizeUnit();

        $query = "SELECT p.id,sku,name,CONCAT_WS('.00 $',price,'') price,CONCAT_WS(' $weightUnit',weight,'') weight,
                    CONCAT_WS(' $sizeUnit',size,'') size, CONCAT_WS('x',height,width,length) dimensions,type   
                    FROM product p 
                    LEFT JOIN book b 
                    ON b.product_id=p.id 
                    LEFT JOIN dvd_disc d 
                    ON d.product_id=p.id 
                    LEFT JOIN furniture f 
                    ON f.product_id=p.id 
                    ORDER BY p.id DESC";

        $results = $this->crud->read($query);

        return $this->queryResults = $results;
    }

    public function getProducts()
    {
        return $this->queryResults;
    }
}

