<?php
namespace App\Modele;

use App\Configs\Configs;
use \PDO;

/**
 * Model class which we have connection to the datebase
 */
class Modele{

    protected $_pdo;

    public function __construct()
    {
        $dns = Configs::getDns();
        $login = Configs::getLogin();
        $pwd = Configs::getPwd();
        $optionspdo =[
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
        ];

        try {

            $this->_pdo = new PDO($dns,$login,$pwd,$optionspdo); 
            
        }catch(\PDOException $ex){
            
            die("Error while connection to the database !!!!!" . $ex->getMessage());
            
    	}

    }

}