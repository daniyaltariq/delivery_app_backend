<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Parcel_Track_History.php';

    function addParcelTrackHistory ($param_id, $param_status, $param_date) {

        // Instantiate DB & connect
        $database = new Database();
        $db = $database->connect();
    
        // Instantiate parcel object
        $pth = new Parcels_tracking_history($db);
        
        // Parcel query
        if($pth->create($param_id, $param_status, $param_date)){
            return true;
        } else {
            // No Parcels
            return false;
        }
    }
