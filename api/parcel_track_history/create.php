<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Parcel_Track_History.php';
    
    require '../parcel_track_history/createFunction.php';

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if(addParcelTrackHistory($data->parcelId, $data->status, $data->date)){
        echo json_encode(
            array('message' => 'Parcel Track Added')
        );
    } else {
        echo json_encode(
            array('message' => 'Parcel Not Added')
        );
    }