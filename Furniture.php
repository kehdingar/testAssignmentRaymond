<?php

class Furniture extends Product
{
    private int $height = 0;
    private int $width = 0;
    private int $length = 0;
    private string $heightUnit = "CM";
    private string $widthUnit = "CM";
    private string $lenthUnit = "CM";
    private static string $frontEndName = "Furniture";


    public function __construct()
    {
        $height = $this->height;
        $width = $this->width;
        $length = $this->length;
        $this->formFields = [
            $$height => $this->heightUnit,
            $$width => $this->widthUnit,
            $$length => $this->lenthUnit
        ];

        $this->fieldGenerator($this->formFields);


    }

    public function getFormFieldInfo($field): string
    {
        $field = ucfirst($field); 
        $methodToCall = "get$field";

        return $methodToCall();
    }

    public function getSizeInfo()
    {
        return "Please provide Dimensions in ". $this->heightUnit;
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