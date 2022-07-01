<?php

abstract class Product
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

    public abstract static function getFrontEndName(): string;
   

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

}

?>

