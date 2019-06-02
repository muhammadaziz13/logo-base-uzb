<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/dbclass.php';
include_once '../domain/company.php';

// instantiate database and department object
$database = new DBClass();
$db = $database->getConnection();

$company = new Company($db);

// query category
$stmt = $company->getAllCompanies();
$num = $stmt->rowCount();


// check if more than 0 record found
if ($num > 0) {
    // category array
    $company_arr = array();
    $company_arr["companies"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);
        $company_item = array(
            "id" => $row['id'],
            "name" => $row['name']
        );
        array_push($company_arr["companies"], $company_item);
    }
    echo json_encode($company_arr);
} else {
    echo json_encode(
            array("message" => "No companies found.")
    );
}

?>