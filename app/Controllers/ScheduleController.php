<?php

namespace LLT\Controllers;


use LLT\Init\Controller;

class ScheduleController extends Controller
{
    private $errorUserInput;

    public function __construct($method, $param)
    {
        parent::__construct($method, $param);
    }

    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = strip_tags($_POST['name']);
            $phone = strip_tags($_POST['phone']);
            $email = strip_tags($_POST['email']);
            $date = strip_tags($_POST['date']);
        }else{
            $this->view->load('404');
        }
    }


}