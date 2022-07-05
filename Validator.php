<?php
include_once 'Session.php';
include_once 'Product.php';
include_once 'DVDDisc.php';
include_once 'Furniture.php';
include_once 'Book.php';

class Validator{

     private $data;

     private $errors = [];
     private $no_error = false;

     private $validation_rules;


   private $messages = [
        "required"  => "This field is required",
        "number"    =>  "This field must be a number greater than 1",
        "invalidProdType" => "Illegal product type"
     ];

   public function __construct($data,$validation_rules)
   {
    $this->data = $data;
    $this->validation_rules = $validation_rules;

   }

   public function validate(){
    //    var_dump($this->validation_rules);

    foreach ($this->validation_rules as $field => $rule) {
          $field_value = $this->getFieldValue($field);
          $rule = ucfirst($rule); 
          $method_to_call = "validate$rule";
          
          $resultant_message = $this->$method_to_call($field_value);
        
        if($resultant_message){
            $this->addError($resultant_message,$field);
        }
    }
    //   die();
        
   }

   public function getFieldValue($field){
        return $this->data[$field];
   }


   public function validateRequired($value){
     return !empty($value)? $this->no_error:$this->messages['required'];
   }

   public function validateNumber($value){
       if(!$value){
           return $this->messages['required'];
        }else{
            try {
                $value = intval($value);
            if(!$value){
                return $this->messages['number'];
                 
            }
            // var_dump($value); die();
            return preg_match("/^[0-9]*$/",$value) ? $this->no_error:$this->messages['number'];
        } catch (Exception $e) {
            return preg_match("/^[0-9]*$/",$value) ? $this->no_error:$this->messages['required'];
            
        }
    }
   }

   public function validateSwitcher($value)
   {
       if($value == ""){
           return $this->messages['required'];
       }
        if(!in_array($value,Product::getChildren(),true)){
            return $this->messages['invalidProdType'];
        }

   }



   public function addError($resultant_message,$field){
    $this->errors[$field] = $resultant_message;
    
    Session::set('errors',$this->errors);

   }

   public static function getErrorForField($field){
          if(Session::exists('errors')){
               $errors = Session::get('errors');

               if(key_exists($field,$errors)){
                    $error = $errors[$field];
                    unset($_SESSION['errors'][$field]);
                    return $error;
               }
          }
   }

   public function validates(){

     return empty($this->errors);

   }

}

?>