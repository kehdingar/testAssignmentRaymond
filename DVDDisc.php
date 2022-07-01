<?php

class DVDDisc extends Product
{
    private int $size = 0;
    private string $sizeUnit = "MB";

    public function __construct()
    {
        $size = $this->size;
        $this->formFields = [
            $$size => $this->sizeUnit
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
        return "Please provide disk space in ". $this->sizeUnit;
    }

    public function getFieldsInfo(): array
    {
        return array_unique($this->formFields);
    }

}
?>