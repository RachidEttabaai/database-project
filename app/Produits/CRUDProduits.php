<?php
namespace App\Produits;

use App\Modele\Modele;

class CRUDProduits extends Modele{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Read produits' datas recorded in the database
     * 
     * @return array
     */
    public function read():array
    {
        $queryshowproducts = "SELECT * FROM Product LEFT JOIN Compagny on Product.product_id = Compagny.product_id";
        $stmtshowproducts  = $this->_pdo->query($queryshowproducts);
        $products = $stmtshowproducts->fetchAll();
        $stmtshowproducts->closeCursor();
        return $products;
    }

    /**
     * Search produits' datas recorded in the database with a parameter in the search form
     * 
     * @return array
     */
    public function search(string $search):array
    {
        $querysearchproducts = "SELECT * FROM Product LEFT JOIN Compagny on Product.product_id = Compagny.product_id WHERE name LIKE ?";
        $stmtsearchproducts = $this->_pdo->prepare($querysearchproducts);
        $stmtsearchproducts->execute(["%$search%"]);
        $searchproducts = $stmtsearchproducts->fetchAll();
        $stmtsearchproducts->closeCursor();
        return $searchproducts;
    }

}