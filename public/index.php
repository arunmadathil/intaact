<?php

require_once "../vendor/autoload.php";

use App\Controller\CourseController;
use App\Controller\StudentController;
use App\Controller\SubscribeCourse;
use App\Core\AppServiceProvider;
use App\Core\RouteServiceProvider;

 $router = new RouteServiceProvider(dirname(__DIR__));

 $app = new AppServiceProvider();
 
 //Stdents
 $router->httpRoutes->get('/student',[new StudentController,'index']);
 $router->httpRoutes->get('/',[new StudentController,'index']);
 
 $router->httpRoutes->get('/student/register',[new StudentController,'create']);
 
 $router->httpRoutes->post('/student/store',[new StudentController,'store']);
 
 $router->httpRoutes->get('/student/edit/{id}',[new StudentController,'edit']);
 
 $router->httpRoutes->post('/student/update/{id}',[new StudentController,'update']);
 
 $router->httpRoutes->get('/student/delete/{id}',[new StudentController,'delete']);

//Course

$router->httpRoutes->get('/course',[new CourseController,'index']);
 
$router->httpRoutes->get('/course/create',[new CourseController,'create']);

$router->httpRoutes->post('/course/store',[new CourseController,'store']);

$router->httpRoutes->get('/course/edit/{id}',[new CourseController,'edit']);

$router->httpRoutes->post('/course/update/{id}',[new CourseController,'update']);

$router->httpRoutes->get('/course/delete/{id}',[new CourseController,'delete']);

$router->httpRoutes->get('/subscribe-course',[new SubscribeCourse,'index']);
$router->httpRoutes->post('/subscribe-course/subscribe',[new SubscribeCourse,'subscribe']);

$router->httpRoutes->post('/subscribe-course/subscribe',[new SubscribeCourse,'subscribe']);

$router->httpRoutes->get('/reports',[new SubscribeCourse,'reports']);



$router->run();



