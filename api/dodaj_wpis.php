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
        !empty($data->wpisNazwaWpisujacego) &&
        !empty($data->wpisTrescWpisu)
) {
    $obj = new KsiegaGosci_obj("", date("Y-m-d H:i:s"), $data->wpisNazwaWpisujacego, $data->wpisTrescWpisu);
    $function = new DBManager();
    $function->zapiszDoBazy($obj);
    http_response_code(201);

    // tell the user
    echo json_encode(array("message" => "Wpis was created."));
} else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create wpis. Data is incomplete."));
}
