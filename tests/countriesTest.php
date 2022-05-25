<?php

    namespace TDD\Test;

    require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

    // use Country;
    use PHPUnit\Framework\TestCase;
    use TDD\controllers\Countries;

    

    class countriesTest extends TestCase 
    {
       
        /**
         * @dataProvider ProvideSayMyName
         */
        public function testSayMyName($input,$expected)
        {
            $countries = new Countries();
            
            $actual = $countries->sayMyName($input);
            $msg = 'this should return ' . $expected;

            $this->assertEquals($expected,$actual,$msg);
        }

        public function ProvideSayMyName()
        {
            return ['test1' =>['Joshua','say my name Joshua'],
                    'test2' =>['Donny','say my name Donny'],
                    'test3' =>['Kris','say my name Kris'],
                    'test4' =>['Bro','say my name Bro'],
                    'test5' =>['France','say my name France']];
        }
    }

