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



    public function setType(Product $type){
        return $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
    

    public function getProductHTML(){
       return $this->type->generatedFields();
    }

    public function getFieldsInfo(){
        return $this->type->getFieldsInfo();
    }

    public function addProduct(){
        $this->validationRules = [
            'type' => 'type',
            'sku' => 'required',
            'name' => 'required',
            'price' => 'number'
        ];

        $type = $_POST['type'];

        

        // Keys matching database columns
        $this->productData = [
            'sku' => $_POST['sku'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'type' => $type,
        ];


        $this->validation_data = $this->productData;
        // array_push($validation_data,['switcher' => $switcher]);
        if(isset($type) && in_array($type,Product::getChildren())){
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
        $this->bookData += [
            'weight' => $_POST['weight']
        ];

        // array_push($this->bookData,[
        //     'weight' => $_POST['weight']
        // ] );

        $this->validationRules += [
            'weight' => 'number'
        ];

        return $this->bookData;

    }

    public function addDVDDisc(){
        $this->dvdDiscData +=  [
            'size' => $_POST['size']
        ];

        $this->validationRules +=  [
            'size' => 'number'
        ];

        return $this->dvdDiscData;

    }

    public function addFurniture(){
        $this->furnitureData += ['height' => $_POST['height']];
        $this->furnitureData  += ['width' => $_POST['width']];
        $this->furnitureData  += ['length' => $_POST['length']];

        $this->validationRules  += ['height' => 'number'];
        $this->validationRules  += ['width' => 'number'];
        $this->validationRules += ['length' => 'number'];

        return $this->furnitureData;

    }
   
}

?>