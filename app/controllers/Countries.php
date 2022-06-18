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
                // $country = $this->countries->getInnerJoin();
            } 
            else
            {
                $country = $this->countries->getCountries();
            }

            echo'   <form name="form" action="" method="get">
                        <input type="text" name="text" id="subject" placeholder="Search Country"><br>
                        <button onclick="this.form.getCountryByAll($value)">Search</button>
                        <button onclick="this.form.getCountries()">Refresh</button>
                        </form>
                        ';
                        
            // <input type="submit" name="ref" value="Refresh">
            $rows = "";
            foreach ($country as $v) {
                $rows .= "<tr>
                        <td>{$v->name}</td>
                        <td>{$v->capitalCity}</td>
                        <td>{$v->continent}</td>
                        <td> " . number_format($v->population,0,'.','.') . "</td>
                        <td>{$v->email}</td>
                        <td><a class='edit' href='".URLROOT."/Countries/update/$v->id'><button><box-icon name='edit-alt'></box-icon></button></a></td>
                        <td><a class='trash' href='".URLROOT."/Countries/delete/$v->id'><button><box-icon name='trash-alt'></box-icon></button></a></td>
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
                header('Refresh:2; url='. URLROOT .'/countries/index');
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
            if ($this->countries->deleteCountry($id)) {
                $data =
                [
                    'deleteStatus' => "<h1 id='success'> Succesfully deleted the record</h1>"
                ];
            } else {
                $data =
                [
                    'deleteStatus' => "<h1 id='fail'> INTERN SERVER ERROR -> The record was not deleted</h1>"
                ];
            }

            $this->view('countries/delete', $data);
            header("Refresh:3; url=" . URLROOT . "/countries/index");
        }

        // create new country 
        public function create() 
        {
            /**
             * default value for the view create.php
             */
            $data = 
            [
                'title' => 'add new country',
                'name' => '',
                'capitalcity' => '',
                'continent' =>'',
                'population' => '',
                'email' => '',
                'nameError' => '',
                'capitalcityError' => '',
                'continentError' => '',
                'populationError' => '',
                'emailError' => ''
            ];
            
            // var_dump($_SERVER);
            if($_SERVER['REQUEST_METHOD'] == 'POST') 
            {
                $data = 
                [
                    'title' => 'add new country',
                    'name' => trim($_POST['name']),
                    'capitalcity' => trim($_POST['capitalcity']),
                    'continent' =>trim($_POST['continent']),
                    'population' => trim($_POST['population']),
                    'email' => trim($_POST['email']),
                    'nameError' => '',
                    'capitalcityError' => '',
                    'continentError' => '',
                    'populationError' => '',
                    'emailError' => ''
                ];

                // sets data in the validatecreateform function and returns $data
                $data = $this->validateCreateForm($data);

                if (   empty($data['nameError'])
                    && empty($data['capitalcityError'])
                    && empty($data['continentError'])
                    && empty($data['populationError'])
                    && empty($data['emailError'])
                    ) {

                    // filter the post array
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    // use details from $_POST and make a new country
                    if ($this->countries->createCountry($_POST)) 
                    {
                        // var_dump($data['continent']);
                       // echo "<div class='alert alert-success' role='alert'> Country was created succesfully </div>";
                        header("Location: " . URLROOT . "/countries/success");
                    } 
                    else 
                    {
                        echo "<div class='alert alert-danger' role='alert'> There was an intern error, Please Try Again </div>";
                        header("Refresh:2; url=" . URLROOT . "/countries/create");
                    }
                }
            }
            // redirect to this page
            $this->view('countries/create', $data);
        }

        public function success()
        {
            $data = [
                "message" => "<div class='alert alert-success' role='alert'> Country was created succesfully </div>"              
            ];

            $this->view("countries/success", $data);

        }

        // checks the $data from create.php and if something is wrong return an error.
        public function validateCreateForm($data) 
        {

            // checks the inserted value from create.php
            // checks name
            if (empty($data['name'])) 
            {
                $data['nameError'] = 'you did not fill in a country name ';
            } 
            elseif (filter_var($data['name'], FILTER_VALIDATE_EMAIL)) 
            {
                $data['nameError'] = 'you filled in an email, this is a name box ';
            } 
            elseif (!preg_match('/^[a-zA-Z]*$/', $data['name'])) 
            {
                $data['nameError'] = 'you cannot use numbers in names ';
            }

            // checks capitalcity
            if (empty($data['capitalcity'])) 
            {
                $data['capitalcityError'] = 'you did not fill in a capitalcity ';
            }

            // checks continent
            if (empty($data['continent'])) 
            {
                $data['continentError'] = 'you did not fill in a continent ';
            }

            // checks population
            if (empty($data['population'])) 
            {
                $data['populationError'] = 'you did not fill in a amount of population ';
            } 
            elseif ($data['population'] > 4294967295) 
            {
                $data['populationError'] = 'the amount is too large ';
            }

            // checks email
            if (empty($data['email'])) 
            {
                $data['emailError'] = 'you did not fill in an email ';
            }

            // returns $data 
            return $data;
        }

        // unit test say my name 
        // returns a name 
        public function sayMyName($name) 
        {
            return 'say my name '. $name;
        }
    }