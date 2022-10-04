<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Parcel_Track_History.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate parcel object
    $pth = new Parcels_tracking_history($db);

    
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $pth->status = $data->status;
    $pth->date = $data->date;
    $pth->parcelId = $data->parcelId;
    
    // Parcel query
    if($pth->update()){
        echo json_encode(
            array('message' => 'Parcel Created')
        );
    } else {
        // can't update
        echo json_encode(
            array('message' => 'Parcel Not Created')
        );
    }
