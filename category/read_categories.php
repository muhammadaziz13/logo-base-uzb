<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/dbclass.php';
include_once '../domain/category.php';

// instantiate database and department object
$database = new DBClass();
$db = $database->getConnection();

$category = new Category($db);

// query category
$stmt = $category->getAllCategories();
$num = $stmt->rowCount();


// check if more than 0 record found
if ($num > 0) {
    // category array
    $category_arr = array();
    $category_arr["categories"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);
        $category_item = array(
            "id" => $row['id'],
            "name" => $row['name']
        );
        array_push($category_arr["categories"], $category_item);
    }
    echo json_encode($category_arr);
} else {
    echo json_encode(
            array("message" => "No categories found.")
    );
}

?>