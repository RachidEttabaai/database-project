<?php
namespace App\Ventes;

use App\Modele\Modele;

/**
 * Ventes' class for sales' management
 */
class Ventes extends Modele{

    /**
     * Ventes' array
     * @var array
     */
    private $_arrayventes;

    /**
     * Constructor of Ventes' Class
     * @param array $arrayventes
     */
    public function __construct(array $arrayventes)
    {
        parent::__construct();
        $this->_arrayventes = $arrayventes;
    }

    /**
     * Get sales' datas from excel file
     * 
     * @return array
     */
    public function getArrayVentes():array
    {
        $keysarr = ["sale_id","customer_id","product_id","date","colorstatus"];
        $res = array_combine($keysarr,$this->_arrayventes);
        return $res;
    }

    /**
    * Check if a sale exist or not in the database
    *
    * @param string $sale_id
    * @return int
    */
    public function checkIfSaleExist(string $sale_id):int
    {
        $querycheck = "SELECT COUNT(*) AS Nbrecords FROM Sale WHERE sale_id = :sale_id";
        $stmtcheck = $this->_pdo->prepare($querycheck);
        $stmtcheck->bindParam(":sale_id",$sale_id);
        $stmtcheck->execute();
        $record = $stmtcheck->fetch();
        $stmtcheck->closeCursor();
        return $record["Nbrecords"];
    }

    /**
     * Add new sales to the database from excel file parsed before
     * 
     * @return void
     */
    public function add()
    {
        $tabsale = $this->getArrayVentes();
        $arrprod = [];
        $datesale = date('Y-m-d H:i:s', strtotime($tabsale["date"]));
        $quantities = 1;
        

        if($this->checkIfSaleExist($tabsale["sale_id"]) > 0)
        {
            //we do nothing
            
        }else{
            $querygetamount = "SELECT * FROM Product WHERE product_id=:product_id";
            $stmtamount = $this->_pdo->prepare($querygetamount);
            $stmtamount->bindParam(":product_id",trim($tabsale["product_id"],"product-"));
            $stmtamount->execute();
            $arrprod = $stmtamount->fetch();
            $stmtamount->closeCursor();

            $amount = $arrprod["price"] * $quantities;

            $queryinsertsale = "INSERT INTO Sale (customer_id,date,colorstatus,montant)
                                VALUES (:customer_id,:date,:colorstatus,:montant)";
            $stmtsale = $this->_pdo->prepare($queryinsertsale);
            $stmtsale->bindParam(":customer_id",trim($tabsale["customer_id"],"customer-"));
            $stmtsale->bindParam(":date",$datesale);
            $stmtsale->bindParam(":colorstatus",$tabsale["colorstatus"]);
            $stmtsale->bindParam(":montant",$amount);
            $stmtsale->execute();
            $stmtsale->closeCursor();

            $queryinsertbasket = "INSERT INTO Basket (sale_id,product_id,price,quantite)
                                VALUES (:sale_id,:product_id,:price,:quantite)";
            $stmtbasket = $this->_pdo->prepare($queryinsertbasket);
            $stmtbasket->bindParam(":sale_id",$tabsale["sale_id"]);
            $stmtbasket->bindParam(":product_id",trim($tabsale["product_id"],"product-"));
            $stmtbasket->bindParam(":price",$arrprod["price"]);
            $stmtbasket->bindParam(":quantite",$quantities);
            $stmtbasket->execute();
            $stmtbasket->closeCursor();
        }
 
    }

}