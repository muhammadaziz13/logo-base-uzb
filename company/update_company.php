<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/dbclass.php';
include_once '../domain/company.php';

$database = new DBClass();
$db = $database->getConnection();

// initialize object
$company = new Company($db);

// get posted data
$data = json_decode(file_get_contents("php://input", true));

$company->id = $data->id;

$company->name = $data->name;


if ($company->updateCompany()) {
    echo '{';
    echo '"message": "Company was updated."';
    echo '}';
} else {
    echo '{';
    echo '"message": "Unable to update company."';
    echo '}';
}