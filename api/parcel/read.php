<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Parcel.php';

    require '../parcel_track_history/read.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate parcel object
    $parcel = new Parcel($db);

    
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $parcel->id = $data->id;

    // Parcel query
    $result = $parcel->read();

    // Get row count
    $num = $result->rowCount();

    // check if any parcel
    if($num > 0) {
        // Post array
        $parcels_arr = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $parcel_item = array(
                'id' => $id,
                'sending_location' => $sending_location,
                'receiving_location' => $receiving_location,
                'consignee' => $consignee,
                'creator' => $creator,
                'track_history' => getParcelTrackHistory($id),
            );
            
            // push to "data
            array_push($parcels_arr, $parcel_item);
        }

        // turn to JSON & output
        echo json_encode($parcels_arr);
    } else {
        // No Parcels
        echo json_encode(
            array('message' => 'No Parcels Found')
        );
    }