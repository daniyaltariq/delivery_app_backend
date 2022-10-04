<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate parcel object
    $users = new Users($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $users->email = $data->email;
    $users->password = $data->password;

    // auth User
    $result = $users->auth();
    
    // Get row count
    $num = $result->rowCount();

    // check if any parcel
    if($num > 0) {
        // user data
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        extract($row);

        $user = array(
            'id' => $id,
            'email' => $email,
            'name' => $name,
            'role' => $role,
        );

        // turn to JSON & output
        echo json_encode($user);
    } else {
        // No user availble
        echo json_encode(
            array(
                'error' => true,
                'message' => 'Invalid email or password'
            )
        );
    }


