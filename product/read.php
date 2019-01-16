<?php
/**
 * Product Read Method
 *
 * @author Junaid Farooqui <junaid.farooqui@alpha.pet>
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/products.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();


// initialize object
$products = new Products($db);

// query products
$stmt = $products->read();
$num = $stmt->rowCount();



// check if more than 0 record found
if($num>0){

    // products array
    $products_arr=array();
    $products_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $product_item=array(
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

        array_push($products_arr["records"], $product_item);
    }

    echo json_encode($products_arr);
}

else{
    echo json_encode(
        array("message" => "No products found.")
    );
}