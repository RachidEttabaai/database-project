<?php
require("vendor/autoload.php");

use App\Clients\CRUDClients;

$limit = 10;

$page = (isset($_GET["page"])) ? intval($_GET["page"]) : 1;

$crudcustomers = new CRUDClients();

$start_from = ($page-1) * $limit; 

$customers = $crudcustomers->readwithpaginate($limit,$start_from);
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
        <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= $customer["customer_id"] ?></td>
                    <td><?= $customer["firstname"] ?></td>
                    <td><?= $customer["lastname"] ?></td>
                    <td><?= $customer["email"] ?></td>
                    <td><?= $customer["phone"] ?></td>
                    <td><?= $customer["address"] ?></td>
                    <td><?= $customer["town"] ?></td>
                    <td><?= $customer["country"] ?></td>
                    <td>
                        <button id="edit" value="<?= $customer["customer_id"] ?>" class="btn btn-info"><em class="far fa-edit"></em></button>
                        <button id="delete" value="<?= $customer["customer_id"] ?>" class="btn btn-danger"><em class="far fa-trash-alt"></em></button>
                    </td>
                </tr>
        <?php endforeach; ?> 
            </tbody>
</table>