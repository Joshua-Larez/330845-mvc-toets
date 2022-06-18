<?php

    namespace TDD\controllers;

    use PDOException;
    use phpDocumentor\Reflection\Location;
    use TDD\libraries\BaseController;

    class Homepage extends BaseController 
    {
        // variable
        // protected $countries;

        // constructor
        public function __construct()
        {
            // $this->countries = $this->model('Home');
            $this->model('Home');
        }

        // selects all records and paste it , when u search a name it selects that and returns that record name.
        public function index() 
        {
            $data = 
            [
                'title' => 'Home Page'
            ];

            $this->view('homepage/index', $data);
        }
    }