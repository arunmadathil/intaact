<?php

namespace App\Core;

class RouteServiceProvider
{
    public static $ROOT_DIR;
    public HttpRoutes $httpRoutes;
    // public static RouteServiceProvider $routeService;
    public Requests $requests;
    public function __construct($root_dir)
    {
        self::$ROOT_DIR = $root_dir;
        // self::$routeService = $this;
        $this->requests = new Requests;
        $this->httpRoutes = new HttpRoutes( $this->requests);
    }

    public function run()
    {
        echo $this->httpRoutes->resolve();
    }
}
