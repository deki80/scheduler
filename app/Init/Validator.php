<?php

namespace LLT\Init;


class Validator
{

    public static function name($name)
    {
        $name = strip_tags($name);
        return strlen($name) < 2 ? ['name' => 'Name must contain more then 2 characters...'] : $name;
    }

}