<?php
 
 namespace App\Controller;

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

    public function redirect($url)
    {
          header('Location:' . $url);
    }

 }