<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/dbclass.php';
include_once '../domain/tag.php';

$database = new DBClass();
$db = $database->getConnection();

// initialize object
$tag = new Tag($db);

// get posted data
$data = json_decode(file_get_contents("php://input", true));

$tag->id = $data->id;

$tag->name = $data->name;


if ($tag->updateTag()) {
    echo '{';
    echo '"message": "Tag was updated."';
    echo '}';
} else {
    echo '{';
    echo '"message": "Unable to update tag."';
    echo '}';
}