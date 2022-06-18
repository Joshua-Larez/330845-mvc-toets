<?php

    use TDD\libraries\Database;
    class Country {
        private $db;

        public $SCRIPT_PATH = '../app/sqlscripts/countriesscript';

        // construct
        public function __construct() 
        {
            $this->db = new Database;
        }

        // // get all country name
        // public function getInnerJoin() 
        // {
        //     try {
        //         $this->db->query("SELECT id FROM country INNER JOIN fruit ON country.id = fruit.id");
        //         $result = $this->db->resultSet();
        //         return $result;

        //     } catch (PDOException $e) {
        //         logger(__FILE__, __METHOD__, __LINE__, $e->getMessage());
        //         return 0;
        //     }
        // }

        // get all country name
        public function getCountries() 
        {
            try {
                $this->db->query("SELECT * FROM country ORDER BY id ASC");
                $result = $this->db->resultSet();
                return $result;

            } catch (PDOException $e) {
                logger(__FILE__, __METHOD__, __LINE__, $e->getMessage());
                return 0;
            }
        }

        // get country by name
        public function getCountryByName() 
        {
            try {
                $conn = new Database();
                $conn->query("SELECT * FROM country WHERE `name` = :name");
                $conn->bind(':name', $_GET['text'] ?? '', PDO::PARAM_STR);
    
                $result = $conn->resultSet();
    
                return $result;

            } catch (PDOException $e) {
                logger(__FILE__, __METHOD__, __LINE__, $e->getMessage());
                return 0;
            }
        }

        // get country by continent
        public function getCountryByContinent() 
        {
            try {
                $conn = new Database();
                $conn->query("SELECT * FROM country WHERE `continent` = :continent");
                $conn->bind(':continent', $_GET['text'] ?? '', PDO::PARAM_STR);
    
                $result = $conn->resultSet();
    
                return $result;

            } catch (PDOException $e) {
                logger(__FILE__, __METHOD__, __LINE__, $e->getMessage());
                return 0;
            }
        }

        // select anything containing the same value as the parameter
        public function getCountryByAll($value) 
        {
            try {
                // make new connection to database
                $conn = new Database();
                // prepare statement
                $conn->query("SELECT * FROM country WHERE concat(`id`, `name`, `capitalCity`, `continent`, `population`, `email`) LIKE '%".$value."%' ");
                // execute statement
                $result = $conn->resultSet();
                // return the value $result
                return $result;

            } catch (PDOException $e) {
                logger(__FILE__, __METHOD__, __LINE__, $e->getMessage());
                return 0;
            }
        }

        // TESTING
        // get all names
        public function getAll() 
        {
            try {
                $allNames = file_get_contents($this->SCRIPT_PATH . "/getAllCountries.sql");
                // $allNames = file_get_contents("../app/sqlscripts/countriesscript/getAllCountries.sql");
                $this->db->query($allNames);
                var_dump($allNames);
                $result = $this->db->resultSet();
                return $result;

            } catch (PDOException $e) {
                logger(__FILE__, __METHOD__, __LINE__, $e->getMessage());
                return 0;
            }
        }

        // select a country by id
        public function getSingleById($id)
        {
            try {
                // $conn = new Database();
                $this->db->query('SELECT * FROM country WHERE `id` = :id');
                $this->db->bind(':id',$id, PDO::PARAM_INT);
                return $this->db->single();

            } catch (PDOException $e) {
                logger(__FILE__, __METHOD__, __LINE__, $e->getMessage());
                return 0;
            }
        }
        
        // update a country details by id
        public function updateById($post)
        {
            try {
                $this->db->query('  UPDATE country 
                                    set `name` = :name,
                                        `capitalCity` = :capitalcity,
                                        `continent` = :continent,
                                        `population` = :population,
                                        `email` = :email
                                    WHERE `id` = :id');
    
                $this->db->bind(':id', $post['id'] , PDO::PARAM_INT);
                $this->db->bind(':name', ucfirst($post['name']), PDO::PARAM_STR);
                $this->db->bind(':capitalcity', ucfirst($post['capitalcity']), PDO::PARAM_STR);
                $this->db->bind(':continent', ucfirst($post['continent']), PDO::PARAM_STR);
                $this->db->bind(':population', $post['population'], PDO::PARAM_INT);
                $this->db->bind(':email', $post['email'], PDO::PARAM_STR);
    
                $this->db->execute();

                return true;

            } catch (PDOException $e) {
                logger(__FILE__, __METHOD__, __LINE__, $e->getMessage());
                return 0;
            }
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
                return true;
            }
            catch(PDOException $e) 
            {
                logger(__FILE__, __METHOD__, __LINE__, $e->getMessage());
                return 0;
            }

        }

        // create a new country name
        public function createCountry($post)
        {
            try {
                // prepare query
                $this->db->query(" INSERT INTO `country` (`id`, `name`, `capitalCity`, `continent`, `population`, `email`) 
                                    VALUES (:id, :name, :capitalcity, :continent, :population, :email)");
                // var_dump($post);exit;
                // set values to table values
                $this->db->bind(':id', null, PDO::PARAM_INT);
                $this->db->bind(':name', ucfirst($post['name']), PDO::PARAM_STR);
                $this->db->bind(':capitalcity', ucfirst($post['capitalcity']), PDO::PARAM_STR);
                $this->db->bind(':continent', ucfirst($post['continent']), PDO::PARAM_STR);
                $this->db->bind(':population', $post['population'], PDO::PARAM_INT);
                $this->db->bind(':email', $post['email'], PDO::PARAM_STR);

                // execute query
                $this->db->execute();
                return true;

            } catch (PDOException $e) { 
                logger(__FILE__, __METHOD__, __LINE__, $e->getMessage());
                return 0;

            }
        }

    }