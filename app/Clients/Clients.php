<?php
namespace App\Clients;

use App\Modele\Modele;

/**
 * Clients' class for clients' management
 */
class Clients extends Modele{

    /**
     * Clients' array
     * @var array
     */
    private $_arrayclients = [];
    public $_records;

    /**
     * Constructor of Clients' Class
     * @param array $arrayclients
     */
    public function __construct(array $arrayclients)
    {
        parent::__construct();
        $this->_arrayclients = $arrayclients;
        $this->_records = [];
    }

    /**
     * Get clients' datas from excel file
     * 
     * @return array
     */
    public function getArrayClients():array
    {
        $keyarr = ["customer_id","firstname","lastname","email","phone","town","address","country"];
        $res = array_combine($keyarr,$this->_arrayclients);
        return $res;
    }

    /**
     * Check if a client exist or not in the database
     *
     * @param string $customer_id
     * @return int
     */
    public function checkIfClientExist(string $customer_id):int
    {
        $querycheck = "SELECT COUNT(*) AS Nbrecords FROM Customer WHERE customer_id = :customer_id";
        $stmtcheck = $this->_pdo->prepare($querycheck);
        $stmtcheck->bindParam(":customer_id",$customer_id);
        $stmtcheck->execute();
        $record = $stmtcheck->fetch();
        $stmtcheck->closeCursor();
        return $record["Nbrecords"];
    }

    /**
     * Add new clients to the database from excel file parsed before
     * 
     * @return void
     */
    public function add()
    {
        $tabclient = $this->getArrayClients();
        $tabaddress = ["Livraison","Facturation"];

        if($this->checkIfClientExist($tabclient["customer_id"]) > 0)
        {
            //we do nothing

        }else{
            $queryinsertcustomer = "INSERT INTO Customer (firstname,lastname,email,phone) 
                                VALUES (:firstname,:lastname,:email,:phone)";
            $stmtcustomer = $this->_pdo->prepare($queryinsertcustomer);
            $stmtcustomer->bindParam(":firstname",$tabclient["firstname"]);
            $stmtcustomer->bindParam(":lastname",$tabclient["lastname"]);
            $stmtcustomer->bindParam(":email",$tabclient["email"]);
            $stmtcustomer->bindParam(":phone",$tabclient["phone"]);
            $stmtcustomer->execute();
            $stmtcustomer->closeCursor();

            $queryinsertaddress = "INSERT INTO Address (customer_id,address_type,address,town,country) 
                                   VALUES (:customer_id,:address_type,:address,:town,:country)";
            $stmtaddress = $this->_pdo->prepare($queryinsertaddress);
            $stmtaddress->bindParam(":customer_id",$tabclient["customer_id"]);
            $stmtaddress->bindParam(":address_type",$tabaddress[random_int(0,1)]);
            $stmtaddress->bindParam(":address",$tabclient["address"]);
            $stmtaddress->bindParam(":town",$tabclient["town"]);
            $stmtaddress->bindParam(":country",$tabclient["country"]);
            $stmtaddress->execute();
            $stmtaddress->closeCursor();
        }
    }
}