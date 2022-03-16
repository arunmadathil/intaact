<?php

namespace App\Core;

class HttpRoutes
{
    protected array $routes = [];
    protected $requests;

    public function __construct(Requests $requests)
    {
        $this->requests = $requests;
    }

    public function get($path, $closssure)
    {
        $this->routes['get'][$path] = $closssure;
    }

    public  function post($path, $closssure)
    {
        $this->routes['post'][$path] = $closssure;
    }

    public function delete()
    {

    }


    public function resolve()
    {
        $path = $this->requests->getPath();

        $method = $this->requests->getMethod();

        $callback = $this->routes[$method][$path];
        if (is_null($callback)) {
            return false;
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    protected function renderView($view)
    {

        $layout_content = $this->renderLayouts();
        $page_content = $this->renderPageContent($view);
        return str_replace("{{content}}",$page_content,$layout_content);
    }

    protected function renderLayouts()
    {
        ob_start();
        include_once(RouteServiceProvider::$ROOT_DIR . "/views/layouts/main.php");
        return ob_get_clean();
    }


    protected function renderPageContent($view)
    {
        ob_start();
        include_once(RouteServiceProvider::$ROOT_DIR . "/views/$view.php");
        return ob_get_clean();
    }
}
