<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // include_once '../../../connection/databaseconnect.php';
    // include_once '../../../controller/select/getViraIndoItemList.php';

    // $database = new Database();
    // $db = $database->getConnection();
    // $item = new getViraIndoItemList($db);

    // $stmt = $item->getViraIndoItemList();
    // $itemCount = $stmt->rowCount();
    // $productArr = array();

    $json_data = '
        [
            {
                "name":"Komponen Komputer",
                "category":[
                    {
                        "name":"processor",
                        "subcategory":[
                            {
                                "name":"intel",
                                "item":[
                                    {
                                        "name":"core i3"
                                    },
                                    {
                                        "name":"core i5"
                                    },
                                    {
                                        "name":"core i7"
                                    },
                                    {
                                        "name":"core i9"
                                    }
                                ]
                            },
                            {
                                "name":"AMD",
                                "item":[
                                    {
                                        "name":"AMD AM4"
                                    },
                                    {
                                        "name":"AMD FM2"
                                    },
                                    {
                                        "name":"AMD FM2+"
                                    },
                                    {
                                        "name":"AMD TR4"
                                    },
                                    {
                                        "name":"AMD sTRX4"
                                    }
                                ]                                   
                            }
                        ]
                    },
                    {
                        "name":"motherboard",
                        "subcategory":[
                            {
                                "name":"",
                                "item":[
                                    {
                                        "name":"Intel"
                                    },
                                    {
                                        "name":"AMD"
                                    },
                                    {
                                        "name":"Afox"
                                    },
                                    {
                                        "name":"Asrock"
                                    },
                                    {
                                        "name":"Asus"
                                    },
                                    {
                                        "name":"Gigabyte"
                                    },
                                    {
                                        "name":"MSI"
                                    },
                                    {
                                        "name":"Galax"
                                    },
                                    {
                                        "name":"Digital Alliance"
                                    }
                                ]
                            }
                        ]                        
                    },
                    {
                        "name":"VGA",
                        "subcategory":[
                            {
                                "name":"",
                                "item":[
                                    {
                                        "name":"Nvidia"
                                    },
                                    {
                                        "name":"Radeon"
                                    },
                                    {
                                        "name":"Asrock"
                                    },
                                    {
                                        "name":"Asus"
                                    },
                                    {
                                        "name":"MSI"
                                    },
                                    {
                                        "name":"Biostar"
                                    }
                                ]
                            }
                        ]                        
                    },
                    {
                        "name":"Power Supply",
                        "subcategory":[]
                    },
                    {
                        "name":"Cooler",
                        "subcategory":[]
                    },
                    {
                        "name":"Keyboard",
                        "subcategory":[]
                    },
                    {
                        "name":"Mouse",
                        "subcategory":[]
                    },
                    {
                        "name":"RAM",
                        "subcategory":[
                            {
                                "name":"",
                                "item":[
                                    {
                                        "name":"DDR2"
                                    },
                                    {
                                        "name":"DDR3"
                                    },
                                    {
                                        "name":"DDR4"
                                    },
                                    {
                                        "name":"4GB"
                                    },
                                    {
                                        "name":"8GB"
                                    },
                                    {
                                        "name":"16GB"
                                    },
                                    {
                                        "name":"32GB"
                                    }
                                ]
                            }
                        ]                        
                    },
                    {
                        "name":"SSD",
                        "subcategory":[
                            {
                                "name":"",
                                "item":[
                                    {
                                        "name":"Adata"
                                    },
                                    {
                                        "name":"Colorful"
                                    },
                                    {
                                        "name":"Corsair"
                                    },
                                    {
                                        "name":"Cube gaming"
                                    },
                                    {
                                        "name":"Gigabyte"
                                    },
                                    {
                                        "name":"Kingston"
                                    },
                                    {
                                        "name":"Samsung"
                                    }
                                ]
                            }
                        ]                        
                    },
                    {
                        "name":"HDD",
                        "subcategory":[
                            {
                                "name":"",
                                "item":[
                                    {
                                        "name":"Seagate"
                                    },
                                    {
                                        "name":"Toshiba"
                                    },
                                    {
                                        "name":"Adata"
                                    },
                                    {
                                        "name":"Western Digital"
                                    },
                                    {
                                        "name":"Hitachi"
                                    }                        
                                ]
                            }
                        ]                        
                    },
                    {
                        "name":"Casing",
                        "subcategory":[
                            {
                                "name":"",
                                "item":[
                                    {
                                        "name":"Aerocool"
                                    },
                                    {
                                        "name":"Bitfenix"
                                    },
                                    {
                                        "name":"MSI"
                                    },
                                    {
                                        "name":"Phanteks"
                                    },
                                    {
                                        "name":"Cube gaming"
                                    }                     
                                ]
                            }
                        ]                        
                    },
                    {
                        "name":"LCD",
                        "subcategory":[
                            {
                                "name":"",
                                "item":[
                                    {
                                        "name":"Acer"
                                    },
                                    {
                                        "name":"AOC"
                                    },
                                    {
                                        "name":"Asus"
                                    },
                                    {
                                        "name":"Samsung"
                                    },
                                    {
                                        "name":"Benq"
                                    }                     
                                ]
                            }
                        ]                        
                    }
                ]
            },
            {
                "name":"Audio",
                "category":[
                    {
                        "name":"Headset",
                        "subcategory":[
                            {
                                "name":"",
                                "item":[
                                    {
                                        "name":"A4Tech"
                                    },
                                    {
                                        "name":"Digital Alliance"
                                    },
                                    {
                                        "name":"HyperX"
                                    },
                                    {
                                        "name":"Logitech"
                                    },
                                    {
                                        "name":"Razer"
                                    },
                                    {
                                        "name":"Sades"
                                    }
                                ]
                            }
                        ]                        
                    },
                    {
                        "name":"Speaker",
                        "subcategory":[
                            {
                                "name":"",
                                "item":[
                                    {
                                        "name":"Edifier"
                                    },
                                    {
                                        "name":"JBL"
                                    },
                                    {
                                        "name":"Simbadda"
                                    },
                                    {
                                        "name":"Microlab"
                                    }
                                ]
                            }
                        ]                        
                    }
                ]
            },
            {
                "name":"PC Branded",
                "category":[
                    {
                        "name":"PC Built Up",
                        "subcategory":[
                            {
                                "name":"",
                                "item":[
                                    {
                                        "name":"Acer"
                                    },
                                    {
                                        "name":"Asus"
                                    },
                                    {
                                        "name":"MSI"
                                    },
                                    {
                                        "name":"Lenovo"
                                    },
                                    {
                                        "name":"HP"
                                    }
                                ]
                            }
                        ]                        
                    }                    
                ]
            }
        ]
    ';

    echo json_encode(json_decode($json_data));    

?>