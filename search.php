<?php
require("vendor/autoload.php");
use App\Clients\CRUDClients;
use App\Produits\CRUDProduits;

$search = (isset($_POST["search"]) && !empty($_POST["search"])) ? $_POST["search"] : "";
$where = (isset($_POST["where"])) ? $_POST["where"] : "";

// echo "search : ".$search;
// echo "where : ".$where;

if($where === "clients")
{
    $clientsearched = new CRUDClients();
    $resultsearchs = $clientsearched->search($search);

    if(count($resultsearchs) === 0 && $search === "")
    {   
        ?>

        <div class="alert alert-danger" role="alert">
            Aucuns résultats pour la recherche du client
        </div>

        <?php

    }else{
?>
<table id="listcustomers" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Courriel</th>
                    <th>Numéro de téléphone</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Pays</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($resultsearchs as $resultsearch): ?>
                <tr>
                    <td><?= $resultsearch["customer_id"] ?></td>
                    <td><?= $resultsearch["firstname"] ?></td>
                    <td><?= $resultsearch["lastname"] ?></td>
                    <td><?= $resultsearch["email"] ?></td>
                    <td><?= $resultsearch["phone"] ?></td>
                    <td><?= $resultsearch["address"] ?></td>
                    <td><?= $resultsearch["town"] ?></td>
                    <td><?= $resultsearch["country"] ?></td>
                    <td>
                        <button id="edit" value="<?= $resultsearch["customer_id"] ?>" class="btn btn-primary"><em class="far fa-edit"></em></button>
                        <button id="view" value="<?= $resultsearch["customer_id"] ?>" class="btn btn-info"><em class="far fa-eye"></em></button>
                        <button id="delete" value="<?= $resultsearch["customer_id"] ?>" class="btn btn-danger"><em class="far fa-trash-alt"></em></button>
                    </td>
                </tr>
        <?php endforeach; ?> 
            </tbody>
</table>
    
<?php
    }
}else if($where === "produits"){

    $productsearched = new CRUDProduits();
    $resultsearchs = $productsearched->search($search);

    if(count($resultsearchs) === 0 && $search === "")
    {   
        ?>

        <div class="alert alert-danger" role="alert">
            Aucuns résultats pour la recherche du produit
        </div>

        <?php

    }else{
?>
<table id="listproducts" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Propriétaire</th>
                    <th>Nom </th>
                    <th>Description</th>
                    <th>Url</th>
                    <th>Mots clés</th>
                    <th>Prix (€)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($resultsearchs as $resultsearch) :?>
                <tr>
                    <td><?= $resultsearch["product_id"] ?></td>
                    <td><?= $resultsearch["name_compagny"] ?></td>
                    <td><?= $resultsearch["name"] ?></td>
                    <td><?= $resultsearch["description"] ?></td>
                    <td><?= $resultsearch["url"] ?></td>
                    <td><?= $resultsearch["keywords"] ?></td>
                    <td><?= $resultsearch["price"] ?></td>
                    <td>
                        <button id="edit" value="<?= $resultsearch["product_id"] ?>" class="btn btn-primary"><em class="far fa-edit"></em></button>
                        <button id="view" value="<?= $resultsearch["product_id"] ?>" class="btn btn-info"><em class="far fa-eye"></em></button>
                        <button id="delete" value="<?= $resultsearch["product_id"] ?>" class="btn btn-danger"><em class="far fa-trash-alt"></em></button>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
<?php
    }
}
