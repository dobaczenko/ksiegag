<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include("../engine/DBManager.php");
include("../obj/KsiegaGosci_obj.php");

$function = new DBManager();
$returnObj = $function->odczytajZBazyWszystkie();

http_response_code(200);
echo json_encode($returnObj);


