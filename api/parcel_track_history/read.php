<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Parcel_Track_History.php';

    function getParcelTrackHistory ($param_id) {

        // Instantiate DB & connect
        $database = new Database();
        $db = $database->connect();
    
        // Instantiate parcel object
        $pth = new Parcels_tracking_history($db);
        
        // Parcel query
        $result = $pth->read($param_id);
    
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
                    'status' => $status,
                    'date' => $date
                );
                
                // push to "data
                array_push($parcels_arr, $parcel_item);
            }
    
            // turn to JSON & output
            return $parcels_arr;
        } else {
            // No Parcels
            return 'No tracking history Found';
        }
    }
