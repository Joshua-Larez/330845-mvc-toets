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
            $this->db->query("SELECT * FROM country order by id");
            $result = $this->db->resultSet();
            return $result;
        }

        // get country by name
        public function getCountryByName() {
            $conn = new Database();
            $conn->query("SELECT * FROM country WHERE `name` = :name");
            $conn->bind(':name', $_GET['text'] ?? '', PDO::PARAM_STR);

            $result = $conn->resultSet();

            return $result;
        }

        // get country by continent
        public function getCountryByContinent() {
            $conn = new Database();
            $conn->query("SELECT * FROM country WHERE `continent` = :continent");
            $conn->bind(':continent', $_GET['text'] ?? '', PDO::PARAM_STR);

            $result = $conn->resultSet();

            return $result;
        }

        // select anything containing the same value as the parameter
        public function getCountryByAll($value) {
            // make new connection to database
            $conn = new Database();
            // prepare statement
            $conn->query("SELECT * FROM country WHERE concat(`id`, `name`, `capitalCity`, `continent`, `population`, `email`) LIKE '%".$value."%' ");
            // execute statement
            $result = $conn->resultSet();
            // return the value $result
            return $result;
        }

        // TESTING
        // get all names
        public function getAll() {
            $allNames = file_get_contents($this->SCRIPT_PATH . "/getAllCountries.sql");
            // $allNames = file_get_contents("../app/sqlscripts/countriesscript/getAllCountries.sql");
            $this->db->query($allNames);
            var_dump($allNames);
            $result = $this->db->resultSet();
            return $result;
        }

        // select a country by id
        public function getSingleById($id)
        {
            // $conn = new Database();
            $this->db->query('SELECT * FROM country WHERE `id` = :id');
            $this->db->bind(':id',$id, PDO::PARAM_INT);
            return $this->db->single();
        }
        
        // update a country details by id
        public function updateById($post)
        {
            $this->db->query('  UPDATE country 
                                set `name` = :name,
                                    `capitalCity` = :capitalcity,
                                    `continent` = :continent,
                                    `population` = :population,
                                    `email` = :email
                                WHERE `id` = :id');

            $this->db->bind(':id', $post['id'] ?? '', PDO::PARAM_INT);
            $this->db->bind(':name', ucfirst($post['name']?? ''), PDO::PARAM_STR);
            $this->db->bind(':capitalcity', ucfirst($post['capitalcity']?? ''), PDO::PARAM_STR);
            $this->db->bind(':continent', ucfirst($post['continent']?? ''), PDO::PARAM_STR);
            $this->db->bind(':population', $post['population']?? '', PDO::PARAM_INT);
            $this->db->bind(':email', $post['email']?? '', PDO::PARAM_STR);

            $this->db->execute();
        }
        
        // delete a country
        public function deleteCountry($id) 
        {

            try 
            {
                // prepare statement
                $this->db->query('DELETE FROM country WHERE id = :id ');
                $this->db->bind('id', $id, PDO::PARAM_INT);
    
                // execute statement
                $this->db->execute();
            }
            catch(PDOException $e) 
            {
                echo $e->getMessage() . 'country not deleted';
            }

        }

        // create a new country name
        public function createCountry($post)
        {
            // prepare query
            $this->db->query(" INSERT INTO `country` (`name`, `capitalCity`, `continent`, `population`, `email`) 
                                VALUES (:name, :capitalcity, :continent, :population, :email)");

            // var_dump($post);exit;

            // set values to table values
            // $this->db->bind(':id', null, PDO::PARAM_INT);
            $this->db->bind(':name', ucfirst($post['name']));
            $this->db->bind(':capitalcity', ucfirst($post['capitalcity']));
            $this->db->bind(':continent', ucfirst($post['continent']));
            $this->db->bind(':population', $post['population']);
            $this->db->bind(':email', $post['email']);

            // execute query
            $this->db->execute();
        }
    }