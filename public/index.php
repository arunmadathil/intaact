<?php

require_once "../vendor/autoload.php";

use App\Controller\StudentController;

use App\Core\AppServiceProvider;

use App\Core\RouteServiceProvider;

 $router = new RouteServiceProvider(dirname(__DIR__));

 $app = new AppServiceProvider();
 
//  $router->httpRoutes->get('/','home');
 

 $router->httpRoutes->get('/student',[new StudentController,'index']);
 $router->httpRoutes->get('/student/create',[new StudentController,'create']);

 $router->httpRoutes->post('/student/store',[new StudentController,'store']);
 $router->httpRoutes->get('/student/edit/{id}',[new StudentController,'edit']);
 $router->httpRoutes->post('/student/update/{id}',[new StudentController,'update']);

//  $router->httpRoutes->get('/contact/show',[new StudentController,'show']);


 $router->run();



