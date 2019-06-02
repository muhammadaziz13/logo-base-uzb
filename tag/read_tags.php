<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/dbclass.php';
include_once '../domain/tag.php';

// instantiate database and department object
$database = new DBClass();
$db = $database->getConnection();

$tag = new Tag($db);

// query category
$stmt = $tag->getAllTag();
$num = $stmt->rowCount();


// check if more than 0 record found
if ($num > 0) {
    // category array
    $tag_arr = array();
    $tag_arr["tags"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);
        $tag_item = array(
            "id" => $row['id'],
            "name" => $row['name']
        );
        array_push($tag_arr["tags"], $tag_item);
    }
    echo json_encode($tag_arr);
} else {
    echo json_encode(
            array("message" => "No tags found.")
    );
}

?>