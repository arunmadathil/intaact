<?php

require_once "../vendor/autoload.php";

use App\Controller\StudentController;
use App\Core\AppServiceProvider;

use App\Core\RouteServiceProvider;

 $router = new RouteServiceProvider(dirname(__DIR__));
 $router->httpRoutes->get('/','home');
 

 $router->httpRoutes->get('/contact',[new StudentController,'index']);

//  $router->httpRoutes->get('/contact','contact');


 $router->run();