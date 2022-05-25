<?php

    namespace TDD\controllers;
    use TDD\libraries\BaseController;

    class Countries extends BaseController {

        // variable
        protected $countries;

        // constructor
        public function __construct()
        {
            $this->countries = $this->model('Country');
        }

        // selects all records and paste it , when u search a name it selects that and returns that record name.
        public function index() 
        {
            if (!empty($_GET['text'])) {
                $country = $this->countries->getCountryByName();
            } else {
                $country = $this->countries->getCountries();
                // die();
            }

            echo'   <form name="form" action="" method="get">
                        <input type="text" name="text" id="subject" value="">
                    </form>
                ';
   
            $rows = "";
            foreach ($country as $v) {
                $test = number_format($v->population,0,'.','.');
                $rows .= "<tr>
                        <th scope='row'>{$v->id}</th>
                        <td>{$v->name}</td>
                        <td>{$v->capitalCity}</td>
                        <td>{$v->continent}</td>
                        <td>{$test}</td>
                        <td><Button><a href='/Countries/update/$v->id'>update</a></Button></td>
                        <td><Button><a href='/Countries/delete/$v->id'>Delete</a></Button></td>
                    </tr>"; 
            }     

            $data = [
                'title' => 'Home Page',
                'country' => $rows

            ];

            $this->view('countries/index', $data);
        }

        // inserts new records
        public function add()
        {
            echo 'add';
        } 

        // edit existing records by ID
        public function update($id)
        {
            // if id is not null and has a id
            if($_SERVER['REQUEST_METHOD'] == 'POST') 
            {
                // var_dump($_SERVER);
                var_dump($_POST);
                // echo'yas';
                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $this->countries->updateById($post);
                header('Location:/countries/index');
                // header('Location:' . URLROOT . '/countries/index');
            }
            else
            {
                // select all from current id
                $name = $this->countries->getSingleById($id);
                var_dump($name);
                var_dump($_SERVER);

                // give data all values
                $data = 
                [
                    'title' => 'Updating page',
                    'names' => $name
                ];

                $this->view('countries/countries_update', $data);
            }
        }

        //  delete records by ID
        public function delete($id)
        {
            echo 'delete';
        }

        // unit test say my name 
        // returns a name 
        public function sayMyName($name) 
        {
            return 'say my name '. $name;
        }
    }