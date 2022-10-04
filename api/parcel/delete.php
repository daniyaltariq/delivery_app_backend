<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Parcel.php';

    require '../parcel_track_history/delete.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate parcel object
    $parcel = new Parcel($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $parcel->id = $data->id;

    // Create Parcel
    if(deleteParcelTrackHistory($data->id)){
        if($parcel->delete()){
            echo json_encode(
                array('message' => 'Parcel Deleted')
            );
        } else {
            echo json_encode(
                array('message' => 'Parcel Not Deleted')
            );
        }
    } else {
        echo json_encode(
            array('message' => 'Parcel Not Deleted')
        );
    }
