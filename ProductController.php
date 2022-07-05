<?php

require_once "Product.php";
require_once "DVDDisc.php";
require_once "Book.php";
require_once "Furniture.php";
require_once "Crud.php";

class ProductController
{
    private Product $type;
    private array $validation_data = array();
    private array $validationRules = array();
    private array $productData = array();
    private array $bookData = array();
    private array $furnitureData = array();
    private array $dvdDiscData = array();



    public function setType(Product $type)
    {
        return $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
    

    public function getProductHTML()
    {
       return $this->type->generatedFields();
    }

    public function getFieldsInfo()
    {
        return $this->type->getFieldsInfo();
    }

    public function addProduct()
    {

        $this->validationRules = [
            'type' => 'type',
            'sku' => 'required',
            'name' => 'required',
            'price' => 'number'
        ];

        // $type = $_POST['type'];
        // var_dump($_POST['sku']);
        // die();

        Product::setType($_POST['type']);
        Product::setName($_POST['name']);
        Product::setSku($_POST['sku']);
        Product::setPrice(json_decode($_POST['price']),true);
        
        // Keys matching database columns
        $this->productData = [
            'sku' => Product::getSku(),
            'name' => Product::getName(),
            'price' => Product::getPrice(),
            'type' => Product::getType(),
        ];


        $this->validation_data = $this->productData;
        // array_push($validation_data,['switcher' => $switcher]);
        if(Product::getType() != '' && in_array(Product::getType(),Product::getChildren())){
            $type = Product::getType();
            $this->setType(new $type);
            $productMethodToCall = "add$type";
            $productTypeData = $this->$productMethodToCall();

            $this->validation_data += $productTypeData;
         
                // $this->validation_data += $data;

            // var_dump($productMethodToCall); die();
           
        //    foreach ($this->$productMethodToCall()[$switcher] as $key => $value) {
        //     $this->validation_data += $value;
        //    }

        //    foreach ($this->$productMethodToCall()['validationRules'] as $key => $value) {
        //     $this->validation_rules += $value;
        //    }

        }

        $validator = new Validator($this->validation_data,$this->validationRules);
        $validator->validate();

        if($validator->validates()){
            
            // $this->crud->create($this->productData,'products')
            // echo json_encode($response);
            // header('location:add-product.php');
            die("No Error");
            
            // echo json_encode($response);
        }else{
            // header('location:add-product.php');
            $response = $_SESSION;
            echo json_encode($response);
        }

    }

    public function addBook(){

        $book = new Book();

        $book->setWeight(json_decode($_POST['weight']),true);

        $this->bookData += ['weight' => $book->getWeight()];

        // array_push($this->bookData,[
        //     'weight' => $_POST['weight']
        // ] );

        $this->validationRules += ['weight' => 'number'];

        return $this->bookData;

    }

    public function addDVDDisc(){

        $dvdDisc = new DVDDisc();

        $dvdDisc->setSize(json_decode($_POST['size']),true);

        $this->dvdDiscData += ['size' => $dvdDisc->getSize()];

        $this->validationRules += ['size' => 'number'];

        return $this->dvdDiscData;

    }

    public function addFurniture(){

        $furniture = new Furniture();
        
        $furniture->setHeight(json_decode($_POST['height']),true);
        $furniture->setWidth(json_decode($_POST['width']),true);
        $furniture->setLength(json_decode($_POST['length']),true);

        $this->furnitureData += ['height' => $furniture->getHeight()];
        $this->furnitureData += ['width' => $furniture->getWidth()];
        $this->furnitureData += ['length' => $furniture->getLength()];

        $this->validationRules += ['height' => 'number'];
        $this->validationRules += ['width' => 'number'];
        $this->validationRules += ['length' => 'number'];

        return $this->furnitureData;

    }
   
}

?>