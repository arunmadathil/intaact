<?php

namespace App\Core;

use DateTime;
use Exception;

class Requests
{

    protected $server;

    protected $requestBody = [];

    public $errors = [];
    public $routeParams = [];

    public function __construct()
    {
        $this->server = $_SERVER;

        $this->getVariables();
    }


    //get path from URI
    public function getPath()
    {
        $path = $this->server['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position) {

            $path = substr($path, 0, $position);
        }

        return $path;
    }

    public function getUrl()
    {
        $path = $this->server['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    //Get the HTTP method
    public function getMethod()
    {
        return strtolower($this->server['REQUEST_METHOD']);
    }

    //Get body of request data from HTTP header for GET method
    public function bodyGet()
    {

        $body = array();

        if ($this->getMethod() == 'get') {

            foreach ($_GET as $key => $value) {

                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS); //Sanitize special characters

            }
        }

        $this->requestBody = $body;

    }

    //Set route with specific value
    public function setRouteParams($params){
        $this->routeParams = $params;
    }

    public function getRouteParams(){
        return $this->routeParams;
    }

    //Get last route value
    public function routeValue(){

        list($value) = end($this->routeParams);

        return $value;

    }

    //Get body of request data from HTTP header for POST method
    public function bodyPost()
    {

        $body = array();

        if ($this->getMethod() == 'post') {

            foreach ($_POST as $key => $value) {

                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS); //Sanitize special characters

            }
        }
        $this->requestBody = $body;
    }



    protected function getVariables()
    {

        if ($this->getMethod() == 'post')
            $this->bodyPost();

        if ($this->getMethod() == 'get')
            $this->bodyGet();

        foreach ($this->requestBody as $param => $value) {

            $this->{$param} = $value;
        }
    }

    public function validate($args = [])
    {

        foreach ($args as $key => $option) { //Iterate for single option

            $options = explode('|', $option);

            foreach ($options  as $method) { //Iterate for option with single or multiple values

                if (method_exists($this, (string)trim($method))) {

                    call_user_func([$this, (string)trim($method)], $key);
                } else {

                    $all_params = explode(':', $method);

                    if (!empty($all_params)) {

                        $method =  (string)trim($all_params[0]);//Remove extra spaces

                        if (method_exists($this, $method)) {
                            
                            //Dynamic method call for each available validation options with parameters
                            call_user_func([$this, (string)trim($method)], ['property' => $key, 'options' => $all_params]); 
                        
                        } else {

                            throw new Exception('Invaild option in validation!');
                        }
                    }
                }
            }
        }

        return $this->errors;
    }
    
    /** Available validation methods */
    protected function email($param)
    {

        if (!filter_var($this->{$param}, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$param][] = "Invalid email address";
        }
        return true;
    }

    protected  function required($param)
    {
        if (is_null($this->{$param}) || empty($this->{$param}) || !$this->{$param}) {

            $this->errors[$param][] = "The $param value is required!";
        }

        return true;
    }


    protected function string($param)
    {

        if ($this->{$param}) {

            if (!preg_match("/^[a-zA-z]*$/", $this->{$param}))
                $this->errors[$param][] = "The $param value must be a string!";
        }

        return true;
    }

    protected function integer($param)
    {

        if (filter_var($this->{$param}, FILTER_VALIDATE_INT)) {

            $this->errors[$param][] = "The field must be numeric a value!";
        }
        return true;
    }

    protected function boolean($param)
    {

        if (filter_var($this->{$param}, FILTER_VALIDATE_BOOLEAN)) {

            $this->errors[$param][] = "The $param value must be a boolean!";
        }
        return true;
    }

    protected function max($params = [])
    {

        $propertyName = $params['property'];
        $options = $params['options'];

        if (strlen($this->{$propertyName}) > $options[1]) {
            $this->errors[$propertyName][] = "The field value should not exceed " . $options[1] . " character in length!";
        }
    }

    protected function min($params = [])
    {

        $propertyName = $params['property'];
        $options = $params['options'];

        if (strlen($this->{$propertyName}) < $options[1]) {
            $this->errors[$propertyName][] = "The field value minimum " . $options[1] . " character in length!";
        }
    }

    protected function date_format($params = [])
    {
        $propertyName = $params['property'];
        $options = $params['options'];
        $d = DateTime::createFromFormat(trim($options[1]), trim($this->{$propertyName}));
        
        if ($d && trim($d->format($options[1])) != trim($this->{$propertyName})) 
            {
                $this->errors[$propertyName][] = 'Invalid date format';
            }
        }
    }
