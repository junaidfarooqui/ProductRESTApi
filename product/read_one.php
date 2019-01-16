<?php
/**
 * One Product Read Method
 *
 * @author Junaid Farooqui <junaid.farooqui@alpha.pet>
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/products.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Products($db);

// set ID property of product to be edited
$product->productCode = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$result = $product->readOne($product->productCode);


// create array
$product_arr = array(
    "productCode" => $productCode,
    "productName" => $productName,
    "productLine" => $productLine,
    "productScale" => $productScale,
    "productVendor" => $productVendor,
    "productDescription" => $productDescription,
    "quantityInStock" => $quantityInStock,
    "buyPrice" => $buyPrice,
    "MSRP" => $MSRP,
);

// make it json format
print_r(json_encode($result));