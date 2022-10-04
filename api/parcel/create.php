<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Parcel.php';

    require '../parcel_track_history/createFunction.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate parcel object
    $parcel = new Parcel($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $parcel->id = $data->id;
    $parcel->sending_location = $data->sending_location;
    $parcel->receiving_location = $data->receiving_location;
    $parcel->consignee = $data->consignee_id;
    $parcel->creator = $data->creator;

    // Create Parcel
    if($parcel->create()){
        if(addParcelTrackHistory($data->id, $data->track_history[0]->status, $data->track_history[0]->date)){
            echo json_encode(
                array('message' => 'Parcel Created')
            );
        } else {
            echo json_encode(
                array('message' => 'Parcel Not Created')
            );
        }
    } else {
        echo json_encode(
            array('message' => 'Parcel Not Created')
        );
    }
