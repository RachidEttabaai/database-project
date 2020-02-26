<?php
namespace App\Produits;

use App\Modele\Modele;

/**
 * Produits' class for products' management
 */
class Produits extends Modele{
    
    /**
     * Produits' array
     * @var array
     */
    private $_arrayproduits;

    /**
     * Constructor of Produits' Class
     * @param array $arrayproduits
     */
    public function __construct(array $arrayproduits)
    {
        parent::__construct();
        $this->_arrayproduits = $arrayproduits;
    }

    /**
     * Get produits' datas from excel file
     * 
     * @return array
     */
    public function getArrayProduits():array
    {
        $keysarr = ["product_id","name_product","name_compagny","description_product","url","keywords","price"];
        $res = array_combine($keysarr,$this->_arrayproduits);
        return $res;
    }

    /**
    * Check if a product exist or not in the database
    *
    * @param string $product_id
    * @return int
    */
    public function checkIfProductExist(string $product_id):int
    {
        $querycheck = "SELECT COUNT(*) AS Nbrecords FROM Product WHERE product_id = :product_id";
        $stmtcheck = $this->_pdo->prepare($querycheck);
        $stmtcheck->bindParam(":product_id",$product_id);
        $stmtcheck->execute();
        $record = $stmtcheck->fetch();
        $stmtcheck->closeCursor();
        return $record["Nbrecords"];
    }

    /**
     * Add new products to the database from excel file parsed before
     * 
     * @return void
     */
    public function add()
    {
        $tabproduit = $this->getArrayProduits();

        if($this->checkIfProductExist($tabproduit["product_id"]) > 0)
        {
            //we do nothing
            
        }else{
            $queryinsertproduct = "INSERT INTO Product (name,description,url,keywords,price)
                               VALUES (:name,:description,:url,:keywords,:price)";
            $stmtproduct = $this->_pdo->prepare($queryinsertproduct);
            $stmtproduct->bindParam(":name",$tabproduit["name_product"]);
            $stmtproduct->bindParam(":description",$tabproduit["description_product"]);
            $stmtproduct->bindParam(":url",$tabproduit["url"]);
            $stmtproduct->bindParam(":keywords",$tabproduit["keywords"]);
            $stmtproduct->bindParam(":price",$tabproduit["price"]);
            $stmtproduct->execute();
            $stmtproduct->closeCursor();

            $queryinsertcompagny = "INSERT INTO Compagny (product_id,name_compagny)
                                    VALUES (:product_id,:name_compagny)";
            $stmtcompagny = $this->_pdo->prepare($queryinsertcompagny);
            $stmtcompagny->bindParam(":product_id",$tabproduit["product_id"]);
            $stmtcompagny->bindParam(":name_compagny",$tabproduit["name_compagny"]);
            $stmtcompagny->execute();
            $stmtcompagny->closeCursor();
        }

    }

}