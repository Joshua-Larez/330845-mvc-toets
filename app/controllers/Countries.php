<?php

    namespace TDD\controllers;

    use PDOException;
    use phpDocumentor\Reflection\Location;
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
            if (!empty($_GET['text'])) 
            {
                $value = $_GET['text'];
                $country = $this->countries->getCountryByAll($value);
            } 
            else
            {
                $country = $this->countries->getCountries();
            }

            echo'   <form name="form" action="" method="get">
                        <input type="text" name="text" id="subject" placeholder="Search Country"><br>
                        <button onclick="this.form.getCountryAll()">Search</button>
                        <button onclick="this.form.getCountries()">Refresh</button>
                        </form>
                        ';
                        
                        // <input type="submit" name="ref" value="Refresh">
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

        // edit existing records by ID
        public function update($id)
        {
            // if id is not null and has a id
            if($_SERVER['REQUEST_METHOD'] == 'POST') 
            {
                // filter array 
                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // updating method
                $this->countries->updateById($post);
                // succesfull message 
                echo 'You updated this record: "' . ucfirst($post['name']) . '" in the database';
                // go to index
                header('Refresh:2; url=/countries/index');
            }
            else
            {
                // select all from current id
                $name = $this->countries->getSingleById($id);

                // give data as $data
                $data = 
                [
                    'title' => 'Updating page',
                    'names' => $name
                ];

                $this->view('countries/update', $data);
            }
        }

        //  delete records by ID
        public function delete($id)
        {

            $this->countries->deleteCountry($id);

            $data =
            [
                'deleteStatus' => "succesfully deleted the record with id : $id"
            ];

            $this->view('countries/delete', $data);
            header("Refresh:2; url=/countries/index");
        }

        // create new country 
        public function create() 
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST') 
            {
                try
                {
                    // filter the post array
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    // var_dump($post);exit;
                    $this->countries->createCountry($_POST);
                    // give succes message
                    echo 'succesfully created a country name named : "' . ucfirst($_POST['name']) . '" in the database';
                    // redirect to index
                    header("Refresh:2; url=/countries/index");
                }
                catch (PDOException $e)
                {
                    echo 'creating new country name did NOT succeed'; 
                    header("Refresh:2; url=/countries/index");

                }
            }
            else
            {
                // give this data as $data in create
                $data = 
                [
                    'title' => 'add new country'
                ];
                $this->view('countries/create', $data);
            }

        }

        // unit test say my name 
        // returns a name 
        public function sayMyName($name) 
        {
            return 'say my name '. $name;
        }
    }