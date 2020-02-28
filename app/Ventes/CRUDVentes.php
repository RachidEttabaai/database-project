<?php
namespace App\Ventes;

use App\Modele\Modele;

class CRUDVentes extends Modele{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Calc count of sellings recorded in the database
     * 
     * @return int
     */
    public function countSellings():int
    {
        $querycountselling = "SELECT COUNT(sale_id) AS Nbsale FROm Sale";
        $stmtcount = $this->_pdo->prepare($querycountselling);
        $stmtcount->execute();
        $countsellings = $stmtcount->fetch();
        $stmtcount->closeCursor();
        return $countsellings["Nbsale"];
    }

    /**
     * Read sellings' datas recorded in the database with pagination system
     * 
     * @return array
     */
    public function readwithpaginate(int $limite,int $start_from):array
    {
        $queryshowsellingswithpaginate = "SELECT * FROM Sale LEFT JOIN Customer ON Sale.customer_id = Customer.customer_id
                                                              LEFT JOIN Basket ON Sale.sale_id = Basket.sale_id
                                                              LEFT JOIN Product ON Basket.product_id = Product.product_id 
                                                              LIMIT :limite OFFSET :start_from";
        $stmtshowsellingswithpaginate = $this->_pdo->prepare($queryshowsellingswithpaginate);
        $stmtshowsellingswithpaginate->bindParam(":start_from",$start_from,\PDO::PARAM_INT);
        $stmtshowsellingswithpaginate->bindParam(":limite",$limite,\PDO::PARAM_INT);
        $stmtshowsellingswithpaginate->execute();
        $sellingswithpaginate = $stmtshowsellingswithpaginate->fetchAll();
        $stmtshowsellingswithpaginate->closeCursor();
        return $sellingswithpaginate;
    }

}