<?php


require_once "Product.php";

class Book extends Product
{
    protected int $weight = 0;
    private string $weightUnit = "Kg";
    private static string  $name = "Book";
    protected array $formFields = array();
    // private string $generatedFields = "";

    public function __construct()
    {
        
        $this->formFields = [
            "weight" => $this->weightUnit
        ];

        

    }

    public function generatedFields(): string{
        // Generated fields in Parent
        return $this->generatedFields = $this->fieldGenerator($this->formFields);
    }

    public function getFormFieldInfo($field): string
    {
        $field = ucfirst($field); 
        $methodToCall = "get$field"."Info";
        $info = $methodToCall;
        return $info;
    }
    
    public function getWeightInfo(): string
    {
        return "Please, provide weight in " .$this->weightUnit;
    }

    public function getFieldsInfo(): array
    {
        return array_unique($this->formFieldsInfo);
    }

    public function getFormFields(): array
    {
        return $this->formFields;
    }

    public function getGeneratedFields(): string
    {
        return $this->generatedFields;
    }

    public static function getName(): string
    {
        return self::$name;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

}

?>