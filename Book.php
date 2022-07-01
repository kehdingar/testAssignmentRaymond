<?php


require_once "Product.php";

class Book extends Product
{
    protected int $weight = 0;
    private string $weightUnit = "Kg";
    private static string  $frontEndName = "Book";

    public function __construct()
    {
        $weight = $this->weight;
        $this->formFields = [
            $$weight => $this->weightUnit
        ];

        $this->fieldGenerator($this->formFields);

    }


    public function getFormFieldInfo($field): string
    {
        $field = ucfirst($field); 
        $methodToCall = "get$field";

        return $methodToCall();
    }

    public function getWeightInfo()
    {
        return "Please provide weight in ". $this->weightUnit;
    }

    public function getFieldsInfo(): array
    {
        return array_unique($this->formFields);
    }

    public static function getFrontEndName(): string
    {
        return self::$frontEndName;
    }

}

?>