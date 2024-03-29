<?php
    class Core 
    {
        protected $currentController = 'countries';
        protected $currentMethod = 'index';
        protected $params = [];
    
        public function __construct(){
            // print_r($this->getUrl());
            $url = $this->getUrl();

            //look in 'çontrollers' for first value, ucwords will capatilize first letter
            if(file_exists('../app/controllers/' . ucwords($url[0] ?? '') . '.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }

            // require the controller 
            require_once '../app/controllers/' . $this->currentController . '.php';

            $cls = 'TDD\\controllers\\' . $this->currentController;
            $this->currentController = new $cls();

            //check for second part of the URL
            if(isset($url[1])) {
                if(method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            //get parameters
            $this->params = $url ? array_values($url) : [];

            //call a callback with array of params 
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){
            if(isset($_GET['url'])) {

                $url = rtrim($_GET['url'], '/');

                $url = filter_var($url, 
                FILTER_SANITIZE_URL);

                $url = explode('/', $url);
                
                return $url;
            }
        }
    }
