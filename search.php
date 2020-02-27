<?php
require("vendor/autoload.php");
use App\Clients\CRUDClients;

$search = (isset($_POST["search"]) && !empty($_POST["search"])) ? $_POST["search"] : "";
$where = (isset($_POST["where"])) ? $_POST["where"] : "";

// echo "search : ".$search;
// echo "where : ".$where;

if($where === "clients")
{
    $clientsearched = new CRUDClients();
    $resultsearchs = $clientsearched->search($search);

    if(count($resultsearchs) === 0)
    {   
        ?>

        <div class="alert alert-danger" role="alert">
            Aucuns résultats pour la recherche
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
}
