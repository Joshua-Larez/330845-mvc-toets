<?php
        
    use TDD\libraries\Database;
    
    class Home {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getUsers() {
            $this->db->query("SELECT * FROM yo");

            $result = $this->db->resultSet();
            
            return $result;
        }

    }