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

    public function generatedFields(): string
    {
        // Generated fields in Parent
        return $this->generatedFields = $this->fieldGenerator($this->formFields);
    }

    public function getdescriptionMessage(): string
    {
        return "Please, provide dimensions: HxWxL in " . $this->heightUnit;
    }

    public function getGeneratedFields(): string
    {
        return $this->generatedFields;
    }

    public static function getDisplayName(): string
    {
        return self::$displayName;
    }

    public function setHeight($height)
    {
        if ($height == null) {

            $this->height = 0;
        } else {

            $this->height = $height;
        }
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setWidth($width)
    {
        if ($width == null) {

            $this->width = 0;
        } else {

            $this->width = $width;
        }
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setLength($length)
    {
        if ($length == null) {

            $this->length = 0;
        } else {

            $this->length = $length;
        }
    }

    public function getLength(): int
    {
        return $this->length;
    }
}
