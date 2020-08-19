<?php

namespace LLT\Controllers;

use LLT\Init\Controller;
use LLT\Init\View;


class PageController extends Controller
{
    public function __construct($method, $param)
    {
        parent::__construct($method, $param);
    }

    public function index()
    {
        $this->view->load('index');
    }

    public static function start()
    {
        echo "Ovo je start stranica";
    }

}