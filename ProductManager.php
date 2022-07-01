<?php

abstract class ProductManager
{
    protected string $generatedFields = "";
    // private $formFields = array('size','weight');
    protected array $formFields = array();
    private string $fieldUnit = "";
    protected array $formFieldInfo = array();
    private static array $productTypes = array();
    protected array $inputMapper = array(
        "int" => "number",
        "string" => "text"
    );


    public abstract function getFormFieldInfo($field): string;

    public function fieldGenerator(array $formFields): string
    {
        foreach ($formFields as $field => $unit) 
        {
            if(!empty($unit)){

                $this->generatedFields .='<div class="form-group">'. '<label>' . ucfirst($field) .' in ('. $unit . ')</label>' . "\n";
                $this->formFieldInfo = $this->getFormFieldInfo($field);
            }else{

                $this->generatedFields .='<div class="form-group">'. '<label>' . ucfirst($field) . '</label>' . "\n";
            }
            $this->generatedFields .= '<input type="' . $this->inputMapper[ (gettype($this->$field)) ] ?? "" .'" id="' . $field . '" name="' . $field . '">' . ucfirst($field) . '</input>' . "</div>\n";

        }
        return $this->generatedFields;
    }

    public static function getProductTypes(): array
    {
        foreach(get_declared_classes() as $type)
        {
            if($type instanceof Product){
                self::$productTypes = $type;
                echo $type;
            }
        }

        return array($type);
        // return array('Proudct1','Product 2','Product 3');
    }


}

?>

