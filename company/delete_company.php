<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../config/dbclass.php';
include_once '../domain/company.php';

$database = new DBClass();
$db = $database->getConnection();

// initialize object
$company = new Company($db);

// set ID property of category to be deleted
$company->id = filter_input(INPUT_GET, 'id');

// delete the category
if ($company->deleteCompany()) {
    echo '{';
    echo '"message": "Company was deleted."';
    echo '}';
}else {
    echo '{';
    echo '"message": "Unable to delete company."';
    echo '}';
}
?>