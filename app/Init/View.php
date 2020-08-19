<?php

namespace LLT\Init;


class View
{

    private $view_name = 'index';

    public function __construct()
    {

    }

    public function load($view = '404', $data = [])
    {

        if(file_exists(VIEWS.$view.'.php')) {
            // $content = file_get_contents(ROOT . '/views/'.$view.'.php');
            require_once VIEWS.$view.'.php';
        } else {
            require_once VIEWS.'404.php';
        }

    }

}