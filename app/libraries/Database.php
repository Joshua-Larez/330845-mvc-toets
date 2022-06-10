<?php

    namespace TDD\libraries;
    require '../app/config/config.php';

    use \PDO;
    use \PDOException;

    class Database {
        private $dbHost = DB_HOST;
        private $dbUser = DB_USER;
        private $dbPass = DB_PASS;
        private $dbName = DB_NAME;

        private $statement;
        private $dbHandler;
        private $error;

        public function __construct() {
            $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            try {
                $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);

            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }
        
        public function getError() {
            return $this->error;
        }

        //allows us to write queries
        public function query($sql) {
            $this->statement = $this->dbHandler->prepare($sql);
        }

        //bind values
        public function bind(string $parameter, mixed $value, ?int $type = null)
        {
            if (is_null($type) || !isset($type)) {
                switch ( gettype($value) ) {
                    case "integer":
                        $type = PDO::PARAM_INT;
                        break;

                    case "boolean":
                        $type = PDO::PARAM_BOOL;
                        break;

                    case "NULL":
                        $type = PDO::PARAM_NULL;
                        break;

                    default:
                        $type = PDO::PARAM_STR;
                        break;
                }
            }

            $this->statement->bindValue($parameter, $value, $type);
        }

        //exucute the prepared statement
        public function execute() {
            return $this->statement->execute();
        }

        //Return an array
        public function resultSet() {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        //return a specific row as an object
        public function single() {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        //get the row count
        public function rowCount() {
            return $this->statement->rowCount();
        }
    }