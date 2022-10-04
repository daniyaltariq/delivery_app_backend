<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate parcel object
    $users = new Users($db);

    // Parcel query
    $result = $users->read();

    // Get row count
    $num = $result->rowCount();

    // check if any parcel
    if($num > 0) {
        // Post array
        $users_arr = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $user = array(
                'id' => $id,
                'email' => $email,
                'name' => $name,
                'role' => $role,
            );
            
            // push to "data
            array_push($users_arr, $user);
        }

        // turn to JSON & output
        echo json_encode($users_arr);
    } else {
        // No Parcels
        echo json_encode(
            array('message' => 'No Users Found')
        );
    }