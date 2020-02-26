<?php
namespace App\Clients;

use App\Modele\Modele;

class CRUDClients extends Modele{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Calc count of customers recorded in the database
     * 
     * @return int
     */
    public function countCustomers():int
    {
        $querycountcustomers = "SELECT COUNT(customer_id) AS Nbcustomers FROM Customer";
        $stmtcount = $this->_pdo->prepare($querycountcustomers);
        $stmtcount->execute();
        $countcustomers = $stmtcount->fetch();
        $stmtcount->closeCursor();
        return $countcustomers["Nbcustomers"];
    }

    /**
     * Read clients' datas recorded in the database
     * 
     * @return array
     */
    public function read():array
    {
        $queryshowcustomers = "SELECT * FROM Customer LEFT JOIN Address on Customer.customer_id = Address.customer_id";
        $stmtshowcustomers  = $this->_pdo->query($queryshowcustomers);
        $customers = $stmtshowcustomers->fetchAll();
        $stmtshowcustomers->closeCursor();
        return $customers;
    }

     /**
     * Read clients' datas recorded in the database with pagination system
     * 
     * @return array
     */
    public function readwithpaginate(int $limite,int $start_from):array
    {
        $queryshowcustomerswithpaginate = "SELECT * FROM Customer LEFT JOIN Address on Customer.customer_id = Address.customer_id LIMIT :limite OFFSET :start_from";
        $stmtshowcustomerswithpaginate = $this->_pdo->prepare($queryshowcustomerswithpaginate);
        $stmtshowcustomerswithpaginate->bindParam(":start_from",$start_from,\PDO::PARAM_INT);
        $stmtshowcustomerswithpaginate->bindParam(":limite",$limite,\PDO::PARAM_INT);
        $stmtshowcustomerswithpaginate->execute();
        $customerswithpaginate = $stmtshowcustomerswithpaginate->fetchAll();
        $stmtshowcustomerswithpaginate->closeCursor();
        return $customerswithpaginate;
    }

    /**
     * Delete clients' datas recorded in the database with his id
     * 
     * 
     */
    public function delete(int $customer_id)
    {

    }

    

}