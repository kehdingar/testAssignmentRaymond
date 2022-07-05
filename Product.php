<?php
require_once "Validator.php";

abstract class Product
{
    protected string $generatedFields = "";
    protected array $formFields = array();
    protected array $inputMapper = array(
        "integer" => "number",
        "string" => "text"
    );

    private static string $sku;
    private static string $name;
    private static float $price;
    private static string $type;


    public abstract function getdescriptionMessage(): string;

    public abstract static function getDisplayName(): string;

    public abstract function generatedFields(): string;


    public function fieldGenerator(array $formFields): string
    {
        foreach ($formFields as $field => $unit) {
            if (!empty($unit)) {

                $this->generatedFields .= '<div class="form-group row">' . '<label class="col-md-1 col-form-label">' . ucfirst($field) . ' (' . $unit . ')</label>' . "\n";
            } else {

                $this->generatedFields .= '<div class="form-group">' . '<label class="col-md-1 col-form-label">' . ucfirst($field) . '</label>' . "\n";
            }
            $this->generatedFields .= '<div class="col-md-4"><input class="form-control" type="' . $this->inputMapper($field) . '" id="' . $field . '" name="' . $field . '" value="' . $field . '"/>' . "</div></div>\n";
            $this->generatedFields .= '<p id="' . $field . 'Error" class="error">' . Validator::getErrorForField($field) . "</p>\n";
        }
        return $this->generatedFields;
    }

    private function inputMapper($field): string
    {
        return $this->inputMapper[(gettype($this->$field))] ?? "";
    }

    public static function getChildren()
    {
        $types = array();
        foreach (get_declared_classes() as $type) {
            if (is_subclass_of($type, 'Product')) {
                array_push($types, $type);
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

    public static function getName(): string
    {
        return self::$name;
    }

    public static function setPrice($price)
    {
        if ($price == null) {

            self::$price = 0.00;
        } else {

            self::$price = $price;
        }
    }

    public static function getPrice(): int
    {
        return self::$price;
    }

    public static function setType($type)
    {
        self::$type = $type;
    }

    public static function getType(): string
    {
        return self::$type;
    }
}
