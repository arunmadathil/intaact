<?php

namespace  App\Core;
session_start();
class  CsrfTokenVerification{

    private static $instance = null;
    public static $token;

    public function __construct()
    {
        $this->generateToken();
    }

    public function generateToken(){
        if (empty($_SESSION['__csrf_token'])) {
            $_SESSION['__csrf_token'] = bin2hex(random_bytes(32));
        }
        self::$token = $_SESSION['__csrf_token'];
    }
    public  static function getToken(){
        return self::$token;
    }

    public function verifyToken(){
        if (!empty($_POST['_csrf_token'])) {
            if (hash_equals($_SESSION['__csrf_token'], $_POST['_csrf_token'])) {
                return true;
            } else {
                die('CSRF token mismatch!');
            }
        }
    }


    public static function getInstance()
    {

        if (!self::$instance) {

            self::$instance = new CsrfTokenVerification();

        }

        return self::$instance;
    }
}

