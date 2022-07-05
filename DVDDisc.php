<?php

class DVDDisc extends Product
{

    protected int $size = 0;
    private string $sizeUnit = "MB";
    public static string $name = "DVD-disk";


    public function __construct()
    {
        $this->formFields = [
            "size" => $this->sizeUnit
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

    public function getSizeInfo()
    {
        return "Please, provide disk space in ". $this->sizeUnit;
    }

    public function getFieldsInfo(): array
    {
        return array_unique($this->formFieldsInfo);
    }

    public function getGeneratedFields(): string
    {
        return $this->generatedFields;
    }

    public static function getName(): string
    {
        return self::$name;
    }

    

}
?>