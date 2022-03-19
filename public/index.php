<?php

require_once "../vendor/autoload.php";

use App\Controller\StudentController;

use App\Core\AppServiceProvider;

use App\Core\RouteServiceProvider;

 $router = new RouteServiceProvider(dirname(__DIR__));

 $app = new AppServiceProvider();
 
 $router->httpRoutes->get('/','home');
 

 $router->httpRoutes->get('/contact',[new StudentController,'index']);

 $router->httpRoutes->post('/contact',[new StudentController,'create']);

 $router->httpRoutes->get('/contact/show',[new StudentController,'show']);


 $router->run();



