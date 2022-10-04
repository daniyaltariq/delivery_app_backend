<?php
    class Users{
        // DB stuff
        private $conn;
        private $table = 'users';

        // Parcel Properties
        public $id;
        public $email;
        public $password;
        public $name;
        public $role;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Users
        public function read() {
            // Create query
            $query = "SELECT id, email, password, name, role FROM " . $this->table;
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);
    
            // Execute query
            $stmt->execute();
    
            return $stmt;
        }

        // Auth single user
        public function readDispatcher() {
            // Create query
            $query = "SELECT id, name FROM " . $this->table . " WHERE role='dispatcher'";
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();
            
            return $stmt;
        }

        // Auth single user
        public function auth() {
            // Create query
            $query = "SELECT id, email, password, name, role FROM " . $this->table . " WHERE email = :email AND password = :password";
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->role = htmlspecialchars(strip_tags($this->role));

            // Bind data
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);

            // Execute query
            $stmt->execute();
            
            return $stmt;
        }

    }