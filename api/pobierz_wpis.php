<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include("../engine/DBManager.php");
include("../obj/KsiegaGosci_obj.php");

$data = json_decode(file_get_contents("php://input"));


if (
        !empty($data->wpisId)
) {

    $function = new DBManager();
    $returnObj = $function->odczytajZBazy($data->wpisId);
    if ($returnObj != "RECORD_NOT_FOUND") {
        http_response_code(200);
        echo json_encode($returnObj);
    } else {
        // set response code - 404 Not found
        http_response_code(404);

        // tell the user product does not exist
        echo json_encode(array("message" => "Wpis does not exist."));
    }
} else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
