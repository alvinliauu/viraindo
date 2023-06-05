<?php

function filterForSorting($arr){

    $theArray = [];
    $arrayOfCat = [];

    $e = ["Price from low to high", "Price from high to low"];
    $id = ["1", "2"];

    $array = ["$arr"];

    $diff = array_diff($e, $array);
    
    foreach ($e as $key => $value) {

        $valueId = $id[$key];

        if($value == $diff[$key]){
            $val = "false";
        } else $val = "true";
        
        $objOfCat = new stdClass();
        $objOfCat->id = $valueId;
        $objOfCat->name = $value;
        $objOfCat->selected = $val;

        array_push($arrayOfCat, $objOfCat);

    }

    return $arrayOfCat;

}

?>