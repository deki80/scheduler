<?php

namespace LLT\Controllers;


use LLT\Init\Controller;
use LLT\Init\Validator;

class ScheduleController extends Controller
{
    private $name, $phone, $email, $date;

    private $errorUserInput = [];

    public function __construct($method, $param)
    {
        parent::__construct($method, $param);
    }

    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = Validator::name($_POST['name']);
            if(is_array($name)) {
                array_push($this->errorUserInput, $name);
            }else{
                $this->name = $name;
            }
            $phone = strip_tags($_POST['phone']);
            $email = strip_tags($_POST['email']);
            $date = strip_tags($_POST['date']);

            if(empty($this->errorUserInput)){
                $this->makeSchedule();
            }else{
                die(var_dump($this->errorUserInput));
            }
        }else{
            $this->view->load('404');
        }
    }

    public function makeSchedule()
    {
        echo "Scheduled";
    }


}