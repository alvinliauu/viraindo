<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once $_SERVER['DOCUMENT_ROOT'] . '/viraindo/repository/filter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/viraindo/repository/filterForSorting.php';

include_once '../../../connection/databaseconnect.php';
include_once '../../../controller/select/getViraIndoCategoryFilter.php';

$database = new Database();
$db = $database->getConnection();

$jsonInput = json_decode(file_get_contents("php://input"), true);
$id = $jsonInput['id'];
$filter = $jsonInput['filter'];
$sort = $jsonInput['sort'];

if (isset($filter)) {
    if (empty($filter)) {
        $arr[] = "";
    } else {
        foreach ($filter as $filt) {
            $name = $filt["name"];

            $arr[] = $name;
        }
    }
}

if ($sort == "" || $sort == "1") {
    $sort = 'ORDER BY TVI.item_name ASC';
    $sortcategory = "Sort A - Z";
} elseif ($sort == "2") {
    $sort = 'ORDER BY TVI.item_name DESC';
    $sortcategory = "Sort Z - A";
} elseif ($sort == "3") {
    $sort = 'ORDER BY TVI.item_new_price ASC';
    $sortcategory = "Price from low to high";
} elseif ($sort == "4") {
    $sort = 'ORDER BY TVI.item_new_price DESC';
    $sortcategory = "Price from high to low";
}

$item = new getViraIndoCategoryFilter($db, $id, $arr, $sort);

$stmt = $item->getViraIndoCategoryFilter();
$itemCount = $stmt->rowCount();

$productArr = array();
$arrOfCatFilter = array();

$results = array();

function strposa($haystack, $needles = array(), $offset = 0)
{
    $chr = array();
    foreach ($needles as $needle) {
        $res = strpos($haystack, $needle, $offset);
        if ($res !== false) $chr[$needle] = $res;
    }
    if (empty($chr)) return false;
    return min($chr);
}

$start = array('(Intel', '(AMD', '(intel');
$end = ")";

if ($itemCount > 0) {

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // create array
        extract($row);

        print_r($row['$category_name']);
        die();

        $explodeItemId = explode("$^$", $row['item_id']);
        $explodeItemName = explode("$^$", $row['item_name']);
        $explodeItemPrice = explode("$^$", $row['item_price']);
        $explodeItemPicture = explode("$^$", $row['item_picture']);


        foreach ($explodeItemName as $key => $value) {

            if ($row['$category_name'] == 'notebook' || $row['category_name'] == 'Notebook') {

                $start_pos = strposa($value, $start, 1);
                $end_pos = strpos($value, $end, $start_pos);

                $substring = substr($value, $start_pos, $end_pos - $start_pos + strlen($end));
            } else {
                $substring = "";
            }


            $val = $explodeItemPrice[$key];
            $itemPict = $explodeItemPicture[$key];
            $itemId = $explodeItemId[$key];

            $theArray = array("id" => $itemId, "name" => $value, "description" => $substring, "price" => $val, "image" => array("url" => $itemPict));

            array_push($results, $theArray);
        }

        print_r($results);
        die();

        $category = array(
            "template" => 1,
            "name" => filter($category_name, $arr)
        );

        $sorting = array(
            "template" => 2,
            "name" => filterForSorting($sortcategory)
        );

        array_push($arrOfCatFilter, $category, $sorting);

        $e = array(
            "id" => $sub_category_id,
            "name" => $sub_category_name,
            "filter" => $arrOfCatFilter,
            "item" => $results
        );
        array_push($productArr, $e);

        http_response_code(200);
    }

    echo json_encode($productArr);
} else {

    $stmtElse = $item->getViraIndoCategoryFilterItemNull();

    while ($row = $stmtElse->fetch(PDO::FETCH_ASSOC)) {
        // create array
        extract($row);

        $results = [];

        $category = array(
            "template" => 1,
            "name" => filter($category_name, $arr)
        );

        $sorting = array(
            "template" => 2,
            "name" => filterForSorting($sortcategory)
        );

        array_push($arrOfCatFilter, $category, $sorting);

        $e = array(
            "id" => $sub_category_id,
            "name" => $sub_category_name,
            "filter" => $arrOfCatFilter,
            "item" => $results
        );

        array_push($productArr, $e);

        http_response_code(200);
    }

    echo json_encode($productArr);
}