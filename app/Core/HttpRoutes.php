<?php

namespace App\Core;

use Exception;

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
    //URL Post requests
    public  function post($path, $closssure)
    {
        $this->routes['post'][$path] = $closssure;
        
    }

    public function delete()
    {
    }

    //Available routing lists
    public function getRouteMap($method): array
    {
        return $this->routes[$method] ?? [];
    }

    public function getCallback()
    {
        $method = $this->requests->getMethod();
        $url = $this->requests->getUrl();
        
        $url = trim($url, '/');
       
        $routes = $this->getRouteMap($method);


        foreach ($routes as $route => $callback) {
            
            $route = trim($route, '/');

            if (!$route) {
                continue;
            }
            // Convert route name into regex pattern
            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

            if (preg_match_all($routeRegex, $url,$matches)) {

                $this->requests->setRouteParams($matches);
                return $callback;

            }
        }

        return false;
    }

    public function resolve()
    {
        $path = $this->requests->getPath();

        $method = $this->requests->getMethod();

        $callback = $this->routes[$method][$path];
      
        if (!$callback) {

            $callback = $this->getCallback();
            if ($callback === false) {
                return 'Page not found';
            }
        }

        if (is_null($callback)) {

            return 'Page not found';
        }

        if (is_string($callback)) {

            return $this->renderView($callback);
        }

        return call_user_func($callback, $this->requests);
    }

    public function renderView($view, $params = [])
    {
       
        $layout_main = $this->renderMain();

        $page_content = $this->renderPageContent(trim($view), $params);

        $header = $this->renderHeader(trim($view));

        $footer = $this->renderFooter(trim($view));


        return str_replace("{{header}}",  $header, 
                str_replace("{{content}}", $page_content, 
                    str_replace("{{footer}}", $footer, $layout_main)));

        
    }

    protected function renderMain($view = null)
    {
        ob_start();

        include_once(RouteServiceProvider::$ROOT_DIR . "/views/layouts/main.php");

        return ob_get_clean();
    }


    protected function renderHeader($view = null)
    {
        ob_start();
        include_once(RouteServiceProvider::$ROOT_DIR . "/views/layouts/header.php");

        return ob_get_clean();
    }

    protected function renderFooter($view = null)
    {
        ob_start();

        include_once(RouteServiceProvider::$ROOT_DIR . "/views/layouts/footer.php");

        return ob_get_clean();
    }
    
    protected function renderPageContent($view, $params = [])
    {
        ob_start();
        
        foreach($params as $key => $value){

            $$key = $value;

        }

        include_once(RouteServiceProvider::$ROOT_DIR . "/views/$view.php");

        return ob_get_clean();
    }

    public function with($params){
        return $this;
    }
}
