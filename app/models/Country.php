<?php

    use TDD\libraries\Database;
    class Country {
        private $db;

        public $SCRIPT_PATH = '../app/sqlscripts/countriesscript';

        // construct
        public function __construct() {
            $this->db = new Database;
        }

        // get all country name
        public function getCountries() 
        {
            $this->db->query("SELECT * FROM country");
            $result = $this->db->resultSet();
            return $result;
        }


        // get country by name
        public function getCountryByName() {
            $conn = new Database();
            $conn->query("SELECT * FROM country WHERE `name` = :name");
            $conn->bind(':name', $_GET['text'] ?? "");

            $result = $conn->resultSet();

            return $result;
        }

        // get all names
        public function getAll() {
            $allNames = file_get_contents($this->SCRIPT_PATH . "/getAllCountries.sql");
            // $allNames = file_get_contents("../app/sqlscripts/countriesscript/getAllCountries.sql");
            $this->db->query($allNames);
            var_dump($allNames);
            $result = $this->db->resultSet();
            return $result;
        }


        public function getSingleById($id)
        {
            // $conn = new Database();
            $this->db->query('SELECT * FROM country WHERE `id` = :id');
            $this->db->bind(':id',$id, PDO::PARAM_INT);
            return $this->db->single();
        }
        
        public function updateById($post)
        {
            // var_dump($post);exit();
            $this->db->query('  UPDATE country 
                                set `name` = :name,
                                    `capitalCity` = :capitalcity,
                                    `continent` = :continentq,
                                    `population` = :population
                                WHERE `id` = :id');

            // var_dump($post['continent']);
            // exit();

            $this->db->bind(':id', $post['id'] ?? '');
            $this->db->bind(':name', $post['name']?? '');
            $this->db->bind(':capitalcity', $post['capitalcity']?? '');
            $this->db->bind(':continentq', $post['continentq']?? '');
            $this->db->bind(':population', $post['population']?? '');

            return $this->db->execute();
        }
        
    }