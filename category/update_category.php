<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/dbclass.php';
include_once '../domain/category.php';

$database = new DBClass();
$db = $database->getConnection();

// initialize object
$category = new Category($db);

// get posted data
$data = json_decode(file_get_contents("php://input", true));

$category->id = $data->id;

$category->name = $data->name;


if ($category->updateCategory()) {
    echo '{';
    echo '"message": "Category was updated."';
    echo '}';
} else {
    echo '{';
    echo '"message": "Unable to update category."';
    echo '}';
}