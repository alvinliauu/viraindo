<?php

function filterForSorting($arr){

    $theArray = [];
    $arrayOfCat = [];

    $e = ["Price from low to high", "Price from high to low"];

    $array = ["$arr"];

    $diff = array_diff($e, $array);
    
    foreach ($e as $key => $value) {

        if($value == $diff[$key]){
            $val = "false";
        } else $val = "true";
        
        $objOfCat = new stdClass();
        $objOfCat->name = $value;
        $objOfCat->flag = $val;

        array_push($arrayOfCat, $objOfCat);

    }

    return $arrayOfCat;

}

?>