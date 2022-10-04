<?php
    class Parcel{
        // DB stuff
        private $conn;
        private $table1 = 'parcels';
        private $table2 = 'parcels_tracking_history';
        private $table3 = 'users';

        // Parcel Properties
        public $id;
        public $sending_location;
        public $receiving_location;
        public $consignee;
        public $creator;


        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Parcels
        public function read() {
            // Create query
            $query = "SELECT tb1.id, tb1.sending_location, tb1.receiving_location, tb2.name as consignee, tb3.name as creator
            FROM " . $this->table1 ." tb1 
            LEFT JOIN ".$this->table3." tb2 ON tb1.consignee = tb2.id
            LEFT JOIN ".$this->table3." tb3 ON tb1.user = tb3.id
            WHERE tb2.id = :id OR tb3.id = :id 
            GROUP BY tb1.id";
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);
    
            // Execute query
            $stmt->execute();
    
            return $stmt;
        }

        // Create Parcels
        public function create() {
            // Create query
            $query = "INSERT INTO " . $this->table1 . "
                SET 
                    id = :id,
                    sending_location = :sending_location,
                    receiving_location = :receiving_location,
                    consignee = :consignee,
                    user = :creator";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->sending_location = htmlspecialchars(strip_tags($this->sending_location));
            $this->receiving_location = htmlspecialchars(strip_tags($this->receiving_location));
            $this->consignee = htmlspecialchars(strip_tags($this->consignee));
            $this->creator = htmlspecialchars(strip_tags($this->creator));

            // Bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':sending_location', $this->sending_location);
            $stmt->bindParam(':receiving_location', $this->receiving_location);
            $stmt->bindParam(':consignee', $this->consignee);
            $stmt->bindParam(':creator', $this->creator);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // print error
            printf("error: %s.\n", $stmt->error);

            return false;

        }

        // Delete Parcel
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table1 . ' WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

    }