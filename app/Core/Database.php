<?php
namespace App\Core;
use PDO;
use PDOException;

class Database
{

    protected $db_config;

    private static $instance = null;

    private $conn;
    
    public function __construct()
    {
        $config = require_once '../config.php';
        $db_config = $config['database'];

        try {
            $this->conn = new PDO(
                "mysql:host={$db_config['host']};
                 dbname={$db_config['db']}",
                $db_config['user'],
                $db_config['password'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );

            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } 
        catch (PDOException $e) {

            die('Something went wrong: ' . $e->getMessage());
            
        }
    }

    public static function getInstance()
    {

        if (!self::$instance) {

            self::$instance = new Database();

        }

        return self::$instance;
    }


    public function getConnection()
    {
        return $this->conn;
    }

    public function dbConfig(){

    }
}
