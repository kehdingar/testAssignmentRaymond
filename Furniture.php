<?php

class Furniture extends Product
{
    protected int $height = 0;
    protected int $width = 0;
    protected int $length = 0;
    private string $heightUnit = "CM";
    private string $widthUnit = "CM";
    private string $lengthUnit = "CM";
    private static string $displayName = "Furniture";


    public function __construct()
    {

        $this->formFields = [
            "height" => $this->heightUnit,
            "width" => $this->widthUnit,
            "length" => $this->lengthUnit
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


    public function getFieldsInfo(): array
    {
        return array_unique($this->formFieldsInfo);
    }

    public function getGeneratedFields(): string
    {
        return $this->generatedFields;
    }

    public function getHeightInfo(): string
    {
        return "Please, Dimensions: LxWxH in " .$this->heightUnit;
    }

    public function getWidthInfo(): string
    {
        return "Please, Dimensions: LxWxH  " .$this->widthUnit;
    }

    public function getLengthInfo(): string
    {
        return "Please, Dimensions: LxWxH " .$this->lengthUnit;
    }

    public static function getDisplayName(): string
    {
        return self::$displayName;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function getLength(): int
    {
        return $this->length;
    }
    

}

?>