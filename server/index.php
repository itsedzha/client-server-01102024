<?php
header("Access-Control-Allow-Origin: *"); 

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$response = array(
    "status" => "success",
    "message" => "Data retrieved successfully.",
    "data" => array(
        array("name" => "John Doe", "age" => 30, "email" => "johndoe@example.com", "location" => "New York"),
        array("name" => "Jane Smith", "age" => 25, "email" => "janesmith@example.com", "location" => "Los Angeles"),
        array("name" => "Andrew Knapp", "age" => 26, "email" => "aknapp@example.com", "location" => "Miami/Florida"),
        array("name" => "Stefanie Anderson", "age" => 39, "email" => "stephq@example.com", "location" => "California"),
        array("name" => "Robert Miller", "age" => 45, "email" => "robbyhq@example.com", "location" => "Ohio"),
        array("name" => "Simon Rodriguez", "age" => 20, "email" => "simonn1998@example.com", "location" => "Arizona"),
        array("name" => "Emily Brown", "age" => 34, "email" => "emilyb@example.com", "location" => "Texas"),
        array("name" => "Michael Thompson", "age" => 41, "email" => "mike.t@example.com", "location" => "Nevada"),
        array("name" => "Olivia Martinez", "age" => 29, "email" => "oliviam@example.com", "location" => "Florida"),
        array("name" => "Daniel Wilson", "age" => 33, "email" => "danielw@example.com", "location" => "Chicago")
    )
);

header('Content-Type: application/json');
echo json_encode($response);
?>
