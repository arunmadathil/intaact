<?php
 namespace App\Controller;
 
 session_start();

 use App\Core\RouteServiceProvider; 
 
 class Controller {

    public $router; 
    
    public function __construct()
    {
        
    }

    public function view($view, $params = [])
    {

        return RouteServiceProvider::$routeService->httpRoutes->renderView($view, $params);
        
    }

    public function redirectRoute(){

    }

    public function redirect($url , $args = [])
    {
        foreach($args as $key => $arg){
            $_SESSION[$key] = $arg;
        }
        header('Location:' . $url);
    }

 }