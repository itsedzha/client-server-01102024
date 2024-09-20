<?php
header("Access-Control-Allow-Origin: *"); 

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$response = array(
    "status" => "success",
    "message" => "Data retrieved successfully.",
    "data" => array(
        array("name" => "John Doe", "age" => 30, "email" => "johndoe@example.com", "location" => "New York"),
        array("name" => "Jane Smith", "age" => 25, "email" => "janesmith@example.com", "location" => "Los Angeles")
    )
);

header('Content-Type: application/json');
echo json_encode($response);
?>
