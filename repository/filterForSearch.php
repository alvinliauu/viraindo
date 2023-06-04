<?php

function filterForSearch($arr){

    $theArray = [];
    $arrayOfCat = [];

    $e = ["Motherboard", "Processor", "HDD", "SSD", "RAM", "VGA", "PSU", "Casing", "Audio", "LCD", "Cooler"];
    
    $diff = array_diff($e, $arr);

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