<?php
    class Countries extends Controller {

        protected $usermodel;

        public function __construct()
        {
            $this->usermodel = $this->model('Country');
        }

        public function index() {
            $country = $this->usermodel->getCountries();

            $data = [
                'title' => 'Home Page',
                'country' => $country

            ];

            $this->view('countries/index', $data);
        }
    }