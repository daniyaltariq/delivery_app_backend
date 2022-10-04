<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Parcel_Track_History.php';

    function deleteParcelTrackHistory ($param_id) {

        // Instantiate DB & connect
        $database = new Database();
        $db = $database->connect();
    
        // Instantiate parcel object
        $pth = new Parcels_tracking_history($db);
        
        // Parcel query
        if($pth->delete($param_id)){
            return true;
        } else {
            // Can't delete Parcels
            return false;
        }
    }
