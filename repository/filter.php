<?php

function filter($category, $arr){

    $theArray = [];

    if($category == "motherboard"){
        $e = ["Intel", "AMD", "Asus", "ASRock", "Biostar", "Gigabyte", "MSI"];
    } elseif ($category == "processor") {
        $e = ["Core i3", "Core i5", "Core i7", "Core i9", "Ryzen 3", "Ryzen 5", "Ryzen 7", "Ryzen 9", "Ryzen Threadripper"];
    } elseif ($category == "ssd") {
        $e = ["Adata", "Apacer", "Corsair", "Crucial", "Gigabyte", "Kingston", "MSI", "Samsung", "Seagate", "128GB", "256GB", "512GB", "1TB"];
    } elseif ($category == "hdd") {
        $e = ["Seagate", "Western Digital", "Toshiba", "Fujitsu", "Hitachi", "HP", "128GB", "256GB", "512GB", "1TB", "2TB", "4TB", "6TB", "8TB"];
    } elseif ($category == "ram") {
        $e = ["Adata", "Apacer", "Corsair", "Crucial Ballistix", "Team T-Force", "Team Elite Plus", "V-Color", "V-GeN", "4GB", "8GB", "16GB", "32GB", "64GB"];
    } elseif ($category == "vga") {
        $e = ["AMD", "ASRock", "Asus", "Colorful", "Galax", "Gigabyte", "2GB", "4GB", "6GB", "8GB", "10GB", "12GB", "24GB"];
    } elseif ($category == "mouse") {
        $e = ["1STPLAYER", "A4Tech", "AOC", "Aula", "Cooler Master", "Corsair", "Ducky", "Digital Alliance", "Logitech", "Powerlogic", "Razer", "Rexus", "SteelSeries", "HyperX"];
    } elseif ($category == "keyboard") {
        $e = ["1STPLAYER", "A4Tech", "AOC", "Aula", "Cooler Master", "Corsair", "Ducky", "Digital Alliance", "Logitech", "Powerlogic", "Razer", "Rexus", "SteelSeries", "HyperX"];
    }

    print_r($e);
    die();

    if($e == $arr){
        $flag = 1;
    } else $flag = 0;

    foreach ($e as $key => $value) {

        $obj = new stdClass();
        $obj->name = $value;
        $obj->flag = $flag;

        array_push($theArray, $obj);
    }

    return $theArray;

    // if($category == "motherboard"){
    //     $e = '[
    //         {
    //             "name": "Intel"
    //         },
    //         {
    //             "name": "AMD"
    //         },
    //         {
    //             "name": "Asus"
    //         },
    //         {
    //             "name": "ASRock"
    //         },
    //         {
    //             "name": "Biostar"
    //         },
    //         {
    //             "name": "Gigabyte"
    //         },
    //         {
    //             "name": "MSI"
    //         }
    //     ]';
    // } elseif ($category == "processor") {
    //     $e = '[
    //         {
    //             "name": "Core i3"
    //         },
    //         {
    //             "name": "Core i5"
    //         },
    //         {
    //             "name": "Core i7"
    //         },
    //         {
    //             "name": "Core i9"
    //         },
    //         {
    //             "name": "Ryzen 3"
    //         },
    //         {
    //             "name": "Ryzen 5"
    //         },
    //         {
    //             "name": "Ryzen 7"
    //         },
    //         {
    //             "name": "Ryzen 9"
    //         },
    //         {
    //             "name": "Ryzen Threadripper"
    //         }
    //     ]';
    // } elseif ($category == "ssd") {
    //     $e = '[
    //         {
    //             "name": "Adata"
    //         },
    //         {
    //             "name": "Apacer"
    //         },
    //         {
    //             "name": "Corsair"
    //         },
    //         {
    //             "name": "Crucial"
    //         },
    //         {
    //             "name": "Gigabyte"
    //         },
    //         {
    //             "name": "Kingston"
    //         },
    //         {
    //             "name": "MSI"
    //         },
    //         {
    //             "name": "Samsung"
    //         },
    //         {
    //             "name": "Seagate"
    //         },
    //         {
    //             "name": "128GB"
    //         },
    //         {
    //             "name": "256GB"
    //         },
    //         {
    //             "name": "512GB"
    //         },
    //         {
    //             "name": "1TB"
    //         }
    //     ]';
    // } elseif ($category == "hdd") {
    //     $e = '[
    //         {
    //             "name": "Seagate"
    //         },
    //         {
    //             "name": "Western Digital"
    //         },
    //         {
    //             "name": "Toshiba"
    //         },
    //         {
    //             "name": "Fujitsu"
    //         },
    //         {
    //             "name": "Hitachi"
    //         },
    //         {
    //             "name": "HP"
    //         },
    //         {
    //             "name": "128GB"
    //         },
    //         {
    //             "name": "256GB"
    //         },
    //         {
    //             "name": "512GB"
    //         },
    //         {
    //             "name": "1TB"
    //         },
    //         {
    //             "name": "2TB"
    //         },
    //         {
    //             "name": "4TB"
    //         },
    //         {
    //             "name": "6TB"
    //         },
    //         {
    //             "name": "8TB"
    //         }
    //     ]';
    // } elseif ($category == "ram") {
    //     $e = '[
    //         {
    //             "name": "Adata"
    //         },
    //         {
    //             "name": "Apacer"
    //         },
    //         {
    //             "name": "Corsair"
    //         },
    //         {
    //             "name": "Crucial Ballistix"
    //         },
    //         {
    //             "name": "Team T-Force"
    //         },
    //         {
    //             "name": "Team Elite Plus"
    //         },
    //         {
    //             "name": "V-Color"
    //         },
    //         {
    //             "name": "V-GeN"
    //         },
    //         {
    //             "name": "4GB"
    //         },
    //         {
    //             "name": "8GB"
    //         },
    //         {
    //             "name": "16GB"
    //         },
    //         {
    //             "name": "32GB"
    //         },
    //         {
    //             "name": "64GB"
    //         }
    //     ]';
    // } elseif ($category == "vga") {
    //     $e = '[
    //         {
    //             "name": "AMD"
    //         },
    //         {
    //             "name": "ASRock"
    //         },
    //         {
    //             "name": "Asus"
    //         },
    //         {
    //             "name": "Colorful"
    //         },
    //         {
    //             "name": "Galax"
    //         },
    //         {
    //             "name": "Gigabyte"
    //         },
    //         {
    //             "name": "2GB"
    //         },
    //         {
    //             "name": "4GB"
    //         },
    //         {
    //             "name": "6GB"
    //         },
    //         {
    //             "name": "8GB"
    //         },
    //         {
    //             "name": "10GB"
    //         },
    //         {
    //             "name": "12GB"
    //         },
    //         {
    //             "name": "24GB"
    //         }
    //     ]';
    // } elseif ($category == "mouse") {
    //     $e = '[
    //         {
    //             "name": "1STPLAYER"
    //         },
    //         {
    //             "name": "A4Tech"
    //         },
    //         {
    //             "name": "AOC"
    //         },
    //         {
    //             "name": "Aula"
    //         },
    //         {
    //             "name": "Cooler Master"
    //         },
    //         {
    //             "name": "Corsair"
    //         },
    //         {
    //             "name": "Ducky"
    //         },
    //         {
    //             "name": "Digital Alliance"
    //         },
    //         {
    //             "name": "Logitech"
    //         },
    //         {
    //             "name": "Powerlogic"
    //         },
    //         {
    //             "name": "Razer"
    //         },
    //         {
    //             "name": "Rexus"
    //         },
    //         {
    //             "name": "SteelSeries"
    //         },
    //         {
    //             "name": "HyperX"
    //         }
    //     ]';
    // } elseif ($category == "keyboard") {
    //     $e = '[
    //         {
    //             "name": "1STPLAYER"
    //         },
    //         {
    //             "name": "A4Tech"
    //         },
    //         {
    //             "name": "AOC"
    //         },
    //         {
    //             "name": "Aula"
    //         },
    //         {
    //             "name": "Cooler Master"
    //         },
    //         {
    //             "name": "Corsair"
    //         },
    //         {
    //             "name": "Ducky"
    //         },
    //         {
    //             "name": "Digital Alliance"
    //         },
    //         {
    //             "name": "Logitech"
    //         },
    //         {
    //             "name": "Powerlogic"
    //         },
    //         {
    //             "name": "Razer"
    //         },
    //         {
    //             "name": "Rexus"
    //         },
    //         {
    //             "name": "SteelSeries"
    //         },
    //         {
    //             "name": "HyperX"
    //         }
    //     ]';
    // } 

    // $json_data = json_decode($e);
    // return $json_data;

}

?>