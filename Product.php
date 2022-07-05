<?php
require_once "Validator.php";

abstract class Product
{
    protected string $generatedFields = "";
    // private $formFields = array('size','weight');
    protected array $formFields = array();
    private string $fieldUnit = "";
    protected array $formFieldsInfo = array();
    private static array $productTypes = array();
    protected array $inputMapper = array(
        "integer" => "number",
        "string" => "text"
    );

    private static string $sku;
    private static string $name;
    private static int $price;
    private static string $type;


    public abstract function getFormFieldInfo($field): string;

    public abstract function getFieldsInfo(): array;

    public abstract static function getDisplayName(): string;

    public abstract function generatedFields(): string;
   

    public function fieldGenerator(array $formFields): string
    {
        foreach ($formFields as $field => $unit) 
        {
            if(!empty($unit)){

                $this->generatedFields .='<div class="form-group">'. '<label>' . ucfirst($field) .' ('. $unit . ')</label>' . "\n";
                $methodToCall = "get".ucfirst($field)."Info";
                $this->formFieldsInfo += [$this->$methodToCall($field)];
            }else{

                $this->generatedFields .='<div class="form-group">'. '<label>' . ucfirst($field) . '</label>' . "\n";
            }
            $this->generatedFields .= '<input type="' . $this->inputMapper($field) . '" id="' . $field . '" name="' . $field .'" value="' . $field . '"/>' . "</div>\n";
            $this->generatedFields .= '<p id="'.$field.'Error" class="error">' .Validator::getErrorForField($field). "</p>\n";


        }
        return $this->generatedFields;
    }

    private function inputMapper($field): string
    {
            return $this->inputMapper[ (gettype($this->$field)) ] ?? "";

    }

    public static function getChildren(){
        $types = array();
        foreach (get_declared_classes() as $type) 
        {
            if (is_subclass_of($type, 'Product')) {
                array_push($types,$type);
            }
        }
        return $types;
    }

    public static function setSku($sku)
    {
        self::$sku = $sku;
    }

    public static function getSku()
    {
        return self::$sku;
    }

    public static function setName($name)
    {
        self::$name = $name;
    }

    public static function getName()
    {
        return self::$name;
    }

    public static function setPrice($price)
    {
        self::$price = $price;
    }

    public static function getPrice()
    {
        return self::$price;
    }

    public static function setType($type)
    {
        self::$type = $type;
    }

    public static function getType()
    {
        return self::$type;
    }

 

}

?>

