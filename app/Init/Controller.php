<?php

namespace LLT\Init;


class Controller {

    protected $view;
    protected $model;
    protected $db;

    public function __construct($method, $param)
    {
        $this->view = new View;

        if(empty($method) || !isset($method)) {
            $method = 'index';
        }
        if(method_exists($this, $method)){
            $this->$method($param);
        }else{
            $this->view->load('404');
        }
    }

}