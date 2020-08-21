<?php

namespace LLT\Controllers;


class Event
{

    private $name, $phone, $email, $start, $end;

    public function registerEvent($name, $phone, $email, $start, $end) {
        $this->name      = $name;
        $this->phone     = $phone;
        $this->email     = $email;
    }

    public function getEventProp($prop) {
        return isset($this->$prop) ? $this->$prop : false;
    }

}