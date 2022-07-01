<?php

include_once "product.php";

class Test extends Product{
    
    
}
$formFields = array('size','weight');

$test = new Test();
$t = $test->fieldGenerator($formFields);

var_dump($t);

?>