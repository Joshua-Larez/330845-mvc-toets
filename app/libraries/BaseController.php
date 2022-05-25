<?php
// load the model and the view

    namespace TDD\libraries;

    class BaseController {
        public function model($model){
            require_once 'C:/Users/baba/Desktop/mvc-toets/app/models/' . $model . '.php';
            // require_once '../app/models/' . $model . '.php';
            //instantiate model
            return new $model(); 
        }

        // load the view (checks for the file)
        public function view($view, $data = []) {
            if (file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            }
            else {
                die('view does not exist');
            }
        }

    }