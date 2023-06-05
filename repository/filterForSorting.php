<?php

function filterForSorting($arr){

    $theArray = [];
    $arrayOfCat = [];

    $e = ["Price from low to high", "Price from high to low "];
    
    $diff = array_diff($e, $arr);
    print_r($diff);
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