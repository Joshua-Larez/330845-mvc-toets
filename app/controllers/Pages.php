<?php

    namespace TDD\controllers;
    use TDD\libraries\BaseController;
    class Pages extends BaseController {

        protected $usermodel;

        public function __construct()
        {
            $this->usermodel = $this->model('User');
        }

        public function index() {
            $users = $this->usermodel->getUsers();

            $data = [
                'title' => 'Home Page',
                'users' => $users
            ];

            $this->view('index', $data);
        }
    }