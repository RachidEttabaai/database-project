<?php
namespace App\Configs;

/**
 * Config class which we have parameters for connection to the datebase
 */
class Configs{

    /**
     * Parameters for connection to the database
     *
     * @var array
     */
    static private $configDB = [
        "host" => "localhost",
        "dbname" => "db_shop",
        "login" => "root",
        "password" => "root"
    ];

    static public function getHost():string
    {
        return self::$configDB["host"];
    }

    static public function getDBName():string
    {
        return self::$configDB["dbname"];
    }

    static public function getLogin():string
    {
        return self::$configDB["login"];
    }

    static public function getPwd():string
    {
        return self::$configDB["password"];
    }

    static public function getDns():string
    {   
        return "mysql:host=".self::$configDB["host"].";dbname=".self::$configDB["dbname"];
    }

}