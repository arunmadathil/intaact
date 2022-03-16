<?php

namespace App\Core;

class Requests
{

    protected $server;

    public function __construct()
    {
        $this->server = $_SERVER;
    }

    //
    public function getPath()
    {
        $path = $this->server['REQUEST_URI'] ?? '/';

        $position = strpos($path, '?');
        if ($position){
            $path = substr($path, 0, $position);
        }

        return $path;
    }

    //
    public function getMethod()
    {
        return strtolower($this->server['REQUEST_METHOD']);
    }

    //
    public function getURI()
    {
        $this->server['REQUEST_URI'];
    }


    public function userData()
    {

    }

    public function validate(){
        
    }
}
