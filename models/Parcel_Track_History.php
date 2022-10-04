<?php
    class Parcels_tracking_history {
        
        // DB stuff
        private $conn;
        private $table = 'parcels_tracking_history';

        // Parcel Properties
        public $id;
        public $status;
        public $date;
        public $parcelId;


        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Parcels
        public function read($id) {
            // Create query
            $query = "SELECT * FROM " . $this->table ." WHERE parcel = '". $id ."'";
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);
    
            // Execute query
            $stmt->execute();
    
            return $stmt;
        }

        public function create($param_id, $param_status, $param_date) {

            // Create query
            $query = "INSERT INTO " . $this->table . "(`status`, `date`, `parcel`) 
                VALUES ('" . $param_status . "','" . $param_date . "','" . $param_id . "')";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // print error
            printf("error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Parcel
        public function delete($id) {
            // Create query
            $query = "DELETE FROM " . $this->table . " WHERE parcel = '" . $id . "'";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // update Parcels
        public function update() {
            // Create query
            $query = "UPDATE " . $this->table . "
                SET 
                    status = :status,
                    date = :date,
                WHERE parcel = :parcelId";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->date = htmlspecialchars(strip_tags($this->date));
            $this->parcelId = htmlspecialchars(strip_tags($this->parcelId));

            // Bind data
            $stmt->bindParam(':status', $this->status);
            $stmt->bindParam(':date', $this->date);
            $stmt->bindParam(':parcelId', $this->parcelId);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // print error
            printf("error: %s.\n", $stmt->error);

            return false;

        }

    }