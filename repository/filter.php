<?php

function filter($category, $arr){

    $theArray = [];
    $arrayOfCat = [];

    if($category == "motherboard" || $category == "Motherboard"){
        $e = ["Intel", "AMD", "Asus", "ASRock", "Biostar", "Gigabyte", "MSI"];
    } elseif ($category == "processor" || $category == "Processor") {
        $e = ["Core i3", "Core i5", "Core i7", "Core i9", "Ryzen 3", "Ryzen 5", "Ryzen 7", "Ryzen 9", "Ryzen Threadripper"];
    } elseif ($category == "ssd" || $category == "SSD" || $category == "Ssd") {
        $e = ["Adata", "Apacer", "Corsair", "Crucial", "Gigabyte", "Kingston", "MSI", "Samsung", "Seagate", "128GB", "256GB", "512GB", "1TB"];
    } elseif ($category == "hdd" || $category == "HDD" || $category == "Hdd") {
        $e = ["Seagate", "Western Digital", "Toshiba", "Fujitsu", "Hitachi", "HP", "128GB", "256GB", "512GB", "1TB", "2TB", "4TB", "6TB", "8TB"];
    } elseif ($category == "ram" || $category == "RAM" || $category == "Ram") {
        $e = ["Adata", "Apacer", "Corsair", "Crucial Ballistix", "Team T-Force", "Team Elite Plus", "V-Color", "V-GeN", "4GB", "8GB", "16GB", "32GB", "64GB"];
    } elseif ($category == "vga" || $category == "Vga" || $category == "VGA") {
        $e = ["AMD", "ASRock", "Asus", "Colorful", "Galax", "Gigabyte", "2GB", "4GB", "6GB", "8GB", "10GB", "12GB", "24GB"];
    } elseif ($category == "mouse" || $category == "Mouse") {
        $e = ["1STPLAYER", "A4Tech", "AOC", "Aula", "Cooler Master", "Corsair", "Ducky", "Digital Alliance", "Logitech", "Powerlogic", "Razer", "Rexus", "SteelSeries", "HyperX"];
    } elseif ($category == "keyboard" || $category == "Keyboard") {
        $e = ["1STPLAYER", "A4Tech", "AOC", "Aula", "Cooler Master", "Corsair", "Ducky", "Digital Alliance", "Logitech", "Powerlogic", "Razer", "Rexus", "SteelSeries", "HyperX"];
    } elseif ($category == "notebook" || $category == "Notebook") {
        $e = ["Acer Notebook", "Asus Notebook", "Dell Notebook", "HP Notebook", "Apple Notebook", "Lenovo Notebook"];
    }
    
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