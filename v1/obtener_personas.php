<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once './db_config.php';
include_once './persona.php';
 
$database = new Database();
$db = $database->getConnection();
 
$persona = new Persona($db);
 
$stmt = $persona->read();
$num = $stmt->rowCount();
 
if($num>0){
 
    $personas_arr=array();
    $personas_arr["datos"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
 
        $persona_item=array(
            "id" => $id,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "descripcion" => $descripcion,
        );
 
        array_push($personas_arr["datos"], $persona_item);
    }
 
    http_response_code(200);
 
    echo json_encode($personas_arr);
}
else{
 
    http_response_code(404);
 
    echo json_encode(
        array("message" => "No existen registros.")
    );
}
 
